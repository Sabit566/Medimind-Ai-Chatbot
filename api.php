<?php
// api.php — MediMind Healthcare AI Backend
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/db.php';

header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, X-Auth-Token');
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { http_response_code(204); exit; }

// ════════════════════════════════════════════
// HEALTHCARE SYSTEM PROMPT
// Injected into every AI request — enforces scope
// ════════════════════════════════════════════
define('HEALTHCARE_SYSTEM_PROMPT', <<<PROMPT
You are MediMind, a dedicated AI healthcare assistant. Your sole purpose is to provide helpful, accurate, and compassionate information strictly within the domain of healthcare and medicine.

YOU ONLY ASSIST WITH:
- General medical information, symptoms, conditions, and diseases
- Medication information (uses, typical dosage guidance, common side effects, interactions — general info only, not prescriptions)
- Healthcare navigation: finding the right doctor/specialist, understanding referrals, preparing for appointments
- Preventive care and wellness: nutrition, exercise, sleep hygiene, vaccinations, mental health self-care
- First aid and emergency guidance — always recommend calling emergency services when life may be at risk
- Medical terminology explained in plain, compassionate language
- Chronic disease management: diabetes, hypertension, asthma, heart disease, etc.
- Mental health awareness: anxiety, depression, stress, coping strategies — always encourage professional support
- Women's health, pediatric health, geriatric care, and all medical specialties
- Understanding lab results, imaging reports, and medical documents at a general educational level
- Healthcare systems, insurance questions, patient rights

STRICT RULES:
1. REFUSE any request not related to healthcare or medicine. If a user asks about coding, writing essays, math, sports, entertainment, travel, or anything non-medical, reply ONLY: "I'm MediMind, your dedicated healthcare assistant. I'm only able to help with health and medical questions. How can I support your wellbeing today?"
2. NEVER provide a specific personal diagnosis. Always say "please consult a licensed healthcare provider for a diagnosis."
3. NEVER advise stopping or changing prescribed medication without consulting a doctor.
4. For ANY symptom discussion, end with: "⚠️ This is general health information, not a diagnosis. Please consult a qualified healthcare professional."
5. For emergencies, ALWAYS lead with: "🚨 If this is a medical emergency, call 112 (or your local emergency number) immediately."
6. Speak with warmth, clarity, and empathy — like a knowledgeable and caring health advisor.
7. If asked who you are or what you do, always identify yourself as MediMind, a healthcare-only AI assistant.
PROMPT
);

$action = $_GET['action'] ?? '';
$method = $_SERVER['REQUEST_METHOD'];

try {
    match(true) {
        $action==='register' && $method==='POST' => doRegister(),
        $action==='login'    && $method==='POST' => doLogin(),
        $action==='me'       && $method==='GET'  => doMe(),
        $action==='logout'   && $method==='POST' => doLogout(),
        default => null,
    } !== null ?: protectedRouter($action, $method);
} catch (PDOException $e) { error(500,'Database error: '.$e->getMessage()); }
  catch (Throwable $e)    { error(500,$e->getMessage()); }

function currentUser(): ?array {
    $token = $_SERVER['HTTP_X_AUTH_TOKEN'] ?? '';
    if (!$token || strlen($token)!==64) return null;
    $st=db()->prepare("SELECT u.id,u.username,u.email,u.display_name,u.avatar_color,u.created_at FROM sessions s JOIN users u ON u.id=s.user_id WHERE s.token=? AND s.expires_at>NOW()");
    $st->execute([$token]);
    return $st->fetch()?:null;
}

function requireAuth(): array { $u=currentUser(); if(!$u) error(401,'Unauthorized — please log in'); return $u; }

function doRegister(): void {
    $b=jsonBody();
    $username=trim($b['username']??''); $email=trim($b['email']??''); $password=$b['password']??'';
    $displayName=trim($b['display_name']??$username);
    if(!$username||!$email||!$password) error(400,'username, email and password are required');
    if(!preg_match('/^[a-zA-Z0-9_]{3,40}$/',$username)) error(400,'Username: 3–40 chars, letters/numbers/underscores only');
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)) error(400,'Invalid email address');
    if(strlen($password)<6) error(400,'Password must be at least 6 characters');
    $check=db()->prepare("SELECT id FROM users WHERE email=? OR username=?"); $check->execute([$email,$username]);
    if($check->fetch()) error(409,'Email or username already taken');
    $colors=['#0ea5a0','#0891b2','#059669','#2563eb','#7c3aed','#0f766e'];
    $color=$colors[array_rand($colors)];
    db()->prepare("INSERT INTO users (username,email,password_hash,display_name,avatar_color) VALUES (?,?,?,?,?)")
        ->execute([$username,$email,password_hash($password,PASSWORD_BCRYPT),$displayName,$color]);
    $userId=(int)db()->lastInsertId();
    $token=createSession($userId);
    json(['token'=>$token,'user'=>fetchUser($userId)]);
}

function doLogin(): void {
    $b=jsonBody(); $login=trim($b['login']??''); $password=$b['password']??'';
    if(!$login||!$password) error(400,'Login and password are required');
    $st=db()->prepare("SELECT * FROM users WHERE email=? OR username=? LIMIT 1"); $st->execute([$login,$login]);
    $user=$st->fetch();
    if(!$user||!password_verify($password,$user['password_hash'])) error(401,'Invalid credentials');
    db()->prepare("UPDATE users SET last_login=NOW() WHERE id=?")->execute([$user['id']]);
    db()->prepare("DELETE FROM sessions WHERE user_id=? AND expires_at<NOW()")->execute([$user['id']]);
    $token=createSession($user['id']);
    json(['token'=>$token,'user'=>fetchUser($user['id'])]);
}

function doMe(): void { $u=currentUser(); if(!$u) error(401,'Not authenticated'); json($u); }

function doLogout(): void {
    $token=$_SERVER['HTTP_X_AUTH_TOKEN']??'';
    if($token) db()->prepare("DELETE FROM sessions WHERE token=?")->execute([$token]);
    json(['ok'=>true]);
}

function protectedRouter(string $action, string $method): void {
    $user=requireAuth();
    match(true){
        $action==='chats'    && $method==='GET'    => listChats($user),
        $action==='chats'    && $method==='POST'   => createChat($user),
        $action==='chat'     && $method==='GET'    => getChat($user),
        $action==='chat'     && $method==='POST'   => updateChat($user),
        $action==='chat'     && $method==='DELETE' => deleteChat($user),
        $action==='messages' && $method==='GET'    => getMessages($user),
        $action==='send'     && $method==='POST'   => sendMessage($user),
        $action==='profile'  && $method==='POST'   => updateProfile($user),
        default => error(404,'Unknown action'),
    };
}

function listChats(array $user): void {
    $st=db()->prepare("SELECT c.chat_uuid,c.title,c.model,c.title_edited,c.created_at,c.updated_at,COUNT(m.id) AS message_count FROM chats c LEFT JOIN messages m ON m.chat_uuid=c.chat_uuid WHERE c.user_id=? GROUP BY c.chat_uuid ORDER BY c.updated_at DESC LIMIT 100");
    $st->execute([$user['id']]); json($st->fetchAll());
}

function createChat(array $user): void {
    $b=jsonBody(); $uuid=generateUUID();
    $title=trim($b['title']??'New consultation')?:'New consultation';
    $model=sanitizeModel($b['model']??ALLOWED_MODELS[0]);
    db()->prepare("INSERT INTO chats (chat_uuid,user_id,title,model) VALUES (?,?,?,?)")->execute([$uuid,$user['id'],$title,$model]);
    json(['chat_uuid'=>$uuid,'title'=>$title,'model'=>$model,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s'),'message_count'=>0]);
}

function getChat(array $user): void { json(chatRow($user,requiredParam('uuid'))); }

function updateChat(array $user): void {
    $uuid=requiredParam('uuid'); chatRow($user,$uuid); $b=jsonBody(); $fields=[]; $params=[];
    if(isset($b['title'])){$fields[]='title=?';$params[]=substr(trim($b['title']),0,255)?:'New consultation';$fields[]='title_edited=1';}
    if(isset($b['model'])){$fields[]='model=?';$params[]=sanitizeModel($b['model']);}
    if($fields){$params[]=$uuid;db()->prepare("UPDATE chats SET ".implode(',',$fields)." WHERE chat_uuid=?")->execute($params);}
    json(['ok'=>true]);
}

function deleteChat(array $user): void {
    $uuid=requiredParam('uuid'); chatRow($user,$uuid);
    db()->prepare("DELETE FROM chats WHERE chat_uuid=?")->execute([$uuid]); json(['ok'=>true]);
}

function getMessages(array $user): void {
    $uuid=requiredParam('uuid'); chatRow($user,$uuid);
    $st=db()->prepare("SELECT role,content,created_at FROM messages WHERE chat_uuid=? ORDER BY id ASC");
    $st->execute([$uuid]); json($st->fetchAll());
}

function sendMessage(array $user): void {
    $b=jsonBody(); $uuid=$b['chat_uuid']??''; $userText=trim($b['message']??'');
    $model=sanitizeModel($b['model']??ALLOWED_MODELS[0]);
    if(!$uuid||!$userText) error(400,'chat_uuid and message are required');
    $chat=chatRow($user,$uuid);
    db()->prepare("UPDATE chats SET model=?,updated_at=NOW() WHERE chat_uuid=?")->execute([$model,$uuid]);
    if($chat['title']==='New consultation'&&!$chat['title_edited'])
        db()->prepare("UPDATE chats SET title=? WHERE chat_uuid=?")->execute([mb_substr($userText,0,60),$uuid]);
    db()->prepare("INSERT INTO messages (chat_uuid,role,content) VALUES (?,'user',?)")->execute([$uuid,$userText]);

    $history=db()->prepare("SELECT role,content FROM messages WHERE chat_uuid=? ORDER BY id ASC");
    $history->execute([$uuid]);
    $dbMsgs=$history->fetchAll();

    // Always inject the healthcare system prompt as the first message
    $messages=array_merge([['role'=>'system','content'=>HEALTHCARE_SYSTEM_PROMPT]],$dbMsgs);

    $start=microtime(true);
    $payload=json_encode(['model'=>$model,'messages'=>$messages,'max_tokens'=>MAX_TOKENS,'temperature'=>min((float)($b['temperature']??0.7),MAX_TEMP)]);
    $ch=curl_init(API_URL);
    curl_setopt_array($ch,[CURLOPT_RETURNTRANSFER=>true,CURLOPT_POST=>true,CURLOPT_POSTFIELDS=>$payload,
        CURLOPT_HTTPHEADER=>['Authorization: Bearer '.API_KEY,'Content-Type: application/json'],
        CURLOPT_TIMEOUT=>60,CURLOPT_SSL_VERIFYPEER=>true]);
    $raw=curl_exec($ch); $httpStatus=(int)curl_getinfo($ch,CURLINFO_HTTP_CODE);
    $elapsed=(int)((microtime(true)-$start)*1000);
    if(curl_errno($ch)){$e=curl_error($ch);curl_close($ch);error(502,'cURL: '.$e);}
    curl_close($ch);

    $resp=json_decode($raw,true);
    if($httpStatus!==200){
        db()->prepare("INSERT INTO api_logs (chat_uuid,user_id,model,status,response_ms) VALUES (?,?,?,?,?)")->execute([$uuid,$user['id'],$model,$httpStatus,$elapsed]);
        http_response_code($httpStatus);echo $raw;exit;
    }
    $reply=$resp['choices'][0]['message']['content']??'';
    $usage=$resp['usage']??[];
    db()->prepare("INSERT INTO messages (chat_uuid,role,content,tokens) VALUES (?,'assistant',?,?)")->execute([$uuid,$reply,$usage['completion_tokens']??null]);
    db()->prepare("INSERT INTO api_logs (chat_uuid,user_id,model,prompt_tokens,completion_tokens,total_tokens,response_ms,status) VALUES (?,?,?,?,?,?,?,200)")
        ->execute([$uuid,$user['id'],$model,$usage['prompt_tokens']??0,$usage['completion_tokens']??0,$usage['total_tokens']??0,$elapsed]);
    $updatedChat=chatRow($user,$uuid);
    json(['reply'=>$reply,'chat_uuid'=>$uuid,'title'=>$updatedChat['title'],'usage'=>$usage]);
}

function updateProfile(array $user): void {
    $b=jsonBody(); $fields=[]; $params=[];
    if(!empty($b['display_name'])){$fields[]='display_name=?';$params[]=substr(trim($b['display_name']),0,80);}
    if(!empty($b['avatar_color'])&&preg_match('/^#[0-9a-fA-F]{6}$/',$b['avatar_color'])){$fields[]='avatar_color=?';$params[]=$b['avatar_color'];}
    if(!empty($b['new_password'])){if(strlen($b['new_password'])<6)error(400,'Password min 6 chars');$fields[]='password_hash=?';$params[]=password_hash($b['new_password'],PASSWORD_BCRYPT);}
    if($fields){$params[]=$user['id'];db()->prepare("UPDATE users SET ".implode(',',$fields)." WHERE id=?")->execute($params);}
    json(fetchUser($user['id']));
}

function chatRow(array $user,string $uuid): array {
    $st=db()->prepare("SELECT * FROM chats WHERE chat_uuid=? AND user_id=?"); $st->execute([$uuid,$user['id']]);
    $r=$st->fetch(); if(!$r) error(404,'Chat not found'); return $r;
}
function createSession(int $userId): string {
    $token=generateToken(); $expires=date('Y-m-d H:i:s',time()+SESSION_TTL);
    db()->prepare("INSERT INTO sessions (token,user_id,expires_at) VALUES (?,?,?)")->execute([$token,$userId,$expires]);
    return $token;
}
function fetchUser(int $id): array {
    $st=db()->prepare("SELECT id,username,email,display_name,avatar_color,created_at,last_login FROM users WHERE id=?"); $st->execute([$id]); return $st->fetch();
}
function sanitizeModel(string $m): string { return in_array($m,ALLOWED_MODELS,true)?$m:ALLOWED_MODELS[0]; }
function jsonBody(): array { return json_decode(file_get_contents('php://input'),true)??[]; }
function requiredParam(string $k): string { $v=$_GET[$k]??''; if(!$v) error(400,"Missing: $k"); return $v; }
function json(mixed $d): never { echo json_encode($d,JSON_UNESCAPED_UNICODE); exit; }
function error(int $code,string $msg): never { http_response_code($code); echo json_encode(['error'=>$msg]); exit; }
