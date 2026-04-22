<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <title>MediMind — Healthcare AI Assistant</title>
  <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no,viewport-fit=cover"/>
  <meta name="theme-color" content="#f0faf9"/>
  <meta name="description" content="MediMind — Your trusted AI healthcare assistant for medical information, wellness guidance, and health support."/>
  <meta name="apple-mobile-web-app-capable" content="yes"/>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&family=DM+Serif+Display:ital@0;1&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet"/>
  <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
  <style>
/* ════════════════════════════════════════════════
   MEDIMIND DESIGN SYSTEM — Clinical Light Theme
   Clean, trustworthy, clinical with warm humanity
════════════════════════════════════════════════ */
*{box-sizing:border-box;margin:0;padding:0}
:root{
  /* Base — warm clinical white */
  --bg:          #f5fbfb;
  --bg2:         #ffffff;
  --bg3:         #eef7f7;
  --surface:     #ffffff;
  --surface2:    #f0faf9;
  --surface3:    #e6f5f4;

  /* Borders */
  --border:      rgba(14,165,160,0.12);
  --border2:     rgba(14,165,160,0.22);
  --border3:     rgba(14,165,160,0.38);

  /* Text */
  --text:        #0f2027;
  --text2:       #4a6a6a;
  --text3:       #8aabab;

  /* Teal accent palette — medical trust */
  --teal:        #0ea5a0;
  --teal2:       #0d9490;
  --teal3:       #0f766e;
  --teal-light:  rgba(14,165,160,0.10);
  --teal-glow:   rgba(14,165,160,0.20);

  /* Semantic */
  --green:       #059669;
  --amber:       #d97706;
  --red:         #dc2626;
  --blue:        #2563eb;

  /* Structure */
  --r-sm:   8px;  --r-md: 14px; --r-lg: 20px; --r-xl: 28px;
  --shadow:   0 2px 16px rgba(14,165,160,0.10);
  --shadow2:  0 6px 32px rgba(14,165,160,0.16);
  --shadow3:  0 12px 48px rgba(0,0,0,0.12);
  --ease:  cubic-bezier(.4,0,.2,1);
  --fast:  150ms; --base: 220ms; --slow: 360ms;
}

html,body{height:100%;overflow:hidden}
body{
  font-family:'DM Sans',system-ui,sans-serif;
  background:var(--bg);color:var(--text);
  -webkit-font-smoothing:antialiased;
  line-height:1.6;letter-spacing:-.005em;
}

/* ════════════════════════════════════════════════
   AUTH PAGE — Split layout
════════════════════════════════════════════════ */
#authOverlay{
  position:fixed;inset:0;z-index:9999;
  background:var(--bg);
  display:flex;align-items:stretch;
  min-height:100vh;
}

/* Left panel — branding */
.auth-left{
  width:42%;flex-shrink:0;
  background:linear-gradient(145deg, #0f766e 0%, #0ea5a0 45%, #06b6d4 100%);
  display:flex;flex-direction:column;justify-content:center;
  padding:60px 48px;position:relative;overflow:hidden;
}
.auth-left::before{
  content:'';position:absolute;inset:0;
  background:url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
  pointer-events:none;
}
.auth-left::after{
  content:'';position:absolute;bottom:-80px;right:-80px;
  width:320px;height:320px;border-radius:50%;
  background:rgba(255,255,255,0.06);
  pointer-events:none;
}
.auth-brand{position:relative;z-index:1}
.auth-brand-icon{
  width:64px;height:64px;background:rgba(255,255,255,0.2);
  border-radius:20px;display:flex;align-items:center;justify-content:center;
  margin-bottom:28px;border:1px solid rgba(255,255,255,0.3);
  backdrop-filter:blur(8px);
}
.auth-brand-icon svg{width:36px;height:36px;color:#fff}
.auth-brand h1{
  font-family:'DM Serif Display',serif;
  font-size:36px;color:#fff;line-height:1.2;margin-bottom:12px;
}
.auth-brand h1 em{font-style:italic;opacity:.85}
.auth-brand p{font-size:15px;color:rgba(255,255,255,.75);line-height:1.65;margin-bottom:40px}
.auth-features{display:flex;flex-direction:column;gap:14px}
.auth-feature{display:flex;align-items:center;gap:12px}
.auth-feature-dot{
  width:32px;height:32px;border-radius:10px;
  background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.2);
  display:flex;align-items:center;justify-content:center;font-size:15px;flex-shrink:0;
}
.auth-feature span{font-size:13.5px;color:rgba(255,255,255,.85);font-weight:500}

/* Right panel — form */
.auth-right{
  flex:1;display:flex;align-items:center;justify-content:center;
  padding:40px 32px;overflow-y:auto;
  background:var(--bg2);
}
.auth-card{width:100%;max-width:400px;animation:authSlide .45s var(--ease)}
@keyframes authSlide{from{opacity:0;transform:translateY(20px)}to{opacity:1;transform:translateY(0)}}

.auth-card-title{
  font-family:'DM Serif Display',serif;
  font-size:28px;color:var(--text);margin-bottom:6px;
}
.auth-card-sub{font-size:14px;color:var(--text2);margin-bottom:28px;line-height:1.5}

.auth-tabs{display:flex;gap:0;background:var(--bg3);border:1px solid var(--border);border-radius:var(--r-md);padding:4px;margin-bottom:26px}
.auth-tab{flex:1;padding:10px;text-align:center;font-size:13.5px;font-weight:600;cursor:pointer;border-radius:10px;color:var(--text2);transition:all var(--base) var(--ease);border:none;background:transparent;font-family:inherit}
.auth-tab.on{background:var(--surface);color:var(--teal);box-shadow:var(--shadow);border:1px solid var(--border2)}

.auth-form{display:flex;flex-direction:column;gap:16px}
.auth-label{display:block;font-size:11.5px;font-weight:600;color:var(--text2);letter-spacing:.05em;text-transform:uppercase;margin-bottom:6px}
.auth-input{
  width:100%;padding:12px 15px;
  background:var(--bg3);border:1px solid var(--border2);
  border-radius:var(--r-md);color:var(--text);
  font-size:15px;font-family:inherit;outline:none;
  transition:border-color var(--base) var(--ease),box-shadow var(--base) var(--ease);
}
.auth-input:focus{border-color:var(--teal);box-shadow:0 0 0 3px var(--teal-glow)}
.auth-input::placeholder{color:var(--text3)}
.two-col{display:grid;grid-template-columns:1fr 1fr;gap:12px}

.auth-btn{
  width:100%;padding:14px;margin-top:4px;
  background:var(--teal);border:none;border-radius:var(--r-md);
  color:#fff;font-size:15px;font-weight:600;cursor:pointer;
  font-family:inherit;letter-spacing:.01em;
  transition:all var(--base) var(--ease);
  box-shadow:0 4px 16px rgba(14,165,160,.3);
}
.auth-btn:hover{background:var(--teal2);transform:translateY(-1px);box-shadow:0 6px 24px rgba(14,165,160,.4)}
.auth-btn:active{transform:translateY(0)}
.auth-btn:disabled{opacity:.6;cursor:not-allowed;transform:none}

.auth-msg{padding:11px 14px;border-radius:var(--r-sm);font-size:13px;font-weight:500;margin-bottom:4px;display:none}
.auth-msg.err{background:rgba(220,38,38,.08);border:1px solid rgba(220,38,38,.2);color:var(--red)}
.auth-msg.ok{background:rgba(5,150,105,.08);border:1px solid rgba(5,150,105,.2);color:var(--green)}

.auth-disclaimer{
  margin-top:20px;padding:12px 14px;background:rgba(14,165,160,.06);
  border:1px solid var(--border2);border-radius:var(--r-sm);
  font-size:12px;color:var(--text2);line-height:1.6;text-align:center;
}
.auth-disclaimer strong{color:var(--teal)}

/* Responsive auth */
@media(max-width:768px){
  #authOverlay{flex-direction:column}
  .auth-left{width:100%;padding:32px 28px;min-height:auto}
  .auth-features{display:none}
  .auth-brand p{display:none}
  .auth-brand h1{font-size:28px}
  .auth-right{padding:28px 20px}
  .two-col{grid-template-columns:1fr}
}

/* ════════════════════════════════════════════════
   APP SHELL
════════════════════════════════════════════════ */
#appShell{display:flex;height:100vh;height:100dvh;overflow:hidden}
#appShell.hidden{display:none}

/* ════════════════════════════════════════════════
   SIDEBAR
════════════════════════════════════════════════ */
.sidebar{
  width:268px;flex-shrink:0;
  background:var(--bg2);border-right:1px solid var(--border);
  display:flex;flex-direction:column;z-index:100;
  transition:transform var(--slow) var(--ease);
  box-shadow:2px 0 16px rgba(14,165,160,.06);
}

.sidebar-top{padding:18px 16px 14px;border-bottom:1px solid var(--border)}
.sidebar-brand{display:flex;align-items:center;gap:11px;margin-bottom:14px}
.brand-icon{
  width:36px;height:36px;border-radius:11px;
  background:linear-gradient(135deg,var(--teal),var(--teal3));
  display:flex;align-items:center;justify-content:center;flex-shrink:0;
  box-shadow:0 3px 12px rgba(14,165,160,.35);
}
.brand-icon svg{width:20px;height:20px;color:#fff}
.brand-name{
  font-family:'DM Serif Display',serif;
  font-size:19px;color:var(--text);letter-spacing:-.01em;
}
.brand-name em{font-style:italic;color:var(--teal)}

.nc-btn{
  width:100%;padding:11px 14px;
  background:var(--teal-light);border:1px solid var(--border2);
  border-radius:var(--r-md);color:var(--teal3);
  font-size:13.5px;font-weight:600;cursor:pointer;
  display:flex;align-items:center;gap:8px;
  transition:all var(--base) var(--ease);font-family:inherit;
}
.nc-btn:hover{background:var(--teal-glow);border-color:var(--border3)}
.nc-btn svg{width:14px;height:14px;flex-shrink:0}

/* Chat category badges */
.sidebar-section{
  padding:6px 16px 3px;
  display:flex;align-items:center;gap:8px;
}
.section-label{font-size:10.5px;font-weight:700;color:var(--text3);text-transform:uppercase;letter-spacing:.07em}
.section-line{flex:1;height:1px;background:var(--border)}

.chat-scroll{flex:1;overflow-y:auto;overflow-x:hidden;padding:6px 8px;display:flex;flex-direction:column;gap:2px}
.chat-scroll::-webkit-scrollbar{width:4px}
.chat-scroll::-webkit-scrollbar-thumb{background:var(--surface3);border-radius:4px}

.chat-item{
  padding:10px 11px;border-radius:var(--r-sm);cursor:pointer;
  display:flex;align-items:center;gap:9px;
  color:var(--text2);font-size:13.5px;
  transition:all var(--fast) var(--ease);position:relative;
}
.chat-item:hover{background:var(--surface2);color:var(--text)}
.chat-item.active{background:var(--teal-light);color:var(--teal3);border:1px solid var(--border2)}
.chat-item-ico{width:17px;height:17px;flex-shrink:0;opacity:.4;display:flex;align-items:center;justify-content:center}
.chat-item-ico svg{width:100%;height:100%}
.chat-item.active .chat-item-ico{opacity:.7}
.chat-item-title{flex:1;min-width:0;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}
.chat-item-del{opacity:0;width:20px;height:20px;border:none;background:transparent;color:var(--text3);cursor:pointer;border-radius:4px;display:flex;align-items:center;justify-content:center;transition:all var(--fast) var(--ease);flex-shrink:0;font-size:12px}
.chat-item:hover .chat-item-del{opacity:1}
.chat-item-del:hover{background:rgba(220,38,38,.1);color:var(--red)}
.chat-title-inp{width:100%;background:var(--surface3);border:1px solid var(--teal);border-radius:6px;padding:3px 7px;color:var(--text);font-size:13.5px;font-family:inherit;outline:none}

/* Sidebar bottom */
.sidebar-bottom{padding:12px 13px;border-top:1px solid var(--border)}
.user-panel{
  display:flex;align-items:center;gap:10px;
  padding:10px 12px;border-radius:var(--r-md);
  background:var(--bg3);border:1px solid var(--border);
  cursor:pointer;transition:all var(--fast) var(--ease);margin-bottom:8px;
}
.user-panel:hover{background:var(--surface2);border-color:var(--border2)}
.user-av{width:32px;height:32px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:13px;font-weight:700;color:#fff;flex-shrink:0}
.user-info{flex:1;min-width:0}
.user-name{font-size:13px;font-weight:600;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;color:var(--text)}
.user-role{font-size:11px;color:var(--teal);font-weight:500}
.user-gear{font-size:14px;color:var(--text3)}

.logout-btn{
  width:100%;padding:9px;border:1px solid var(--border);border-radius:var(--r-md);
  background:transparent;color:var(--text2);font-size:13px;font-weight:500;
  cursor:pointer;font-family:inherit;transition:all var(--fast) var(--ease);
  display:flex;align-items:center;justify-content:center;gap:6px;
}
.logout-btn:hover{background:rgba(220,38,38,.06);border-color:rgba(220,38,38,.2);color:var(--red)}

/* ════════════════════════════════════════════════
   MAIN AREA
════════════════════════════════════════════════ */
.main{flex:1;display:flex;flex-direction:column;min-width:0;background:var(--bg);position:relative;overflow:hidden}

/* Mobile header */
.mob-hdr{
  display:none;padding:12px 16px;background:var(--bg2);
  border-bottom:1px solid var(--border);
  align-items:center;gap:12px;z-index:50;
  box-shadow:0 1px 8px rgba(14,165,160,.08);
}
.mob-hdr h1{font-family:'DM Serif Display',serif;font-size:18px;flex:1;display:flex;align-items:center;gap:9px;color:var(--text)}
.mob-brand-icon{width:30px;height:30px;border-radius:9px;background:linear-gradient(135deg,var(--teal),var(--teal3));display:flex;align-items:center;justify-content:center}
.mob-brand-icon svg{width:17px;height:17px;color:#fff}
.ham{width:38px;height:38px;border:1px solid var(--border);background:var(--surface);border-radius:var(--r-sm);color:var(--text2);cursor:pointer;display:flex;align-items:center;justify-content:center;transition:all var(--base) var(--ease);flex-shrink:0}
.ham:hover{background:var(--surface2);color:var(--teal)}
.ham svg{width:19px;height:19px}

/* Model bar */
.model-bar{position:absolute;top:16px;right:16px;z-index:10}
.sel-btn{
  background:var(--surface);border:1px solid var(--border2);
  padding:8px 14px;border-radius:40px;font-size:12px;font-weight:600;color:var(--text2);
  cursor:pointer;display:flex;align-items:center;gap:6px;
  transition:all var(--base) var(--ease);box-shadow:var(--shadow);
}
.sel-btn:hover{background:var(--surface2);border-color:var(--teal);color:var(--teal)}
.sel-drop{position:absolute;top:calc(100% + 8px);right:0;background:var(--surface);border:1px solid var(--border2);border-radius:var(--r-md);min-width:210px;box-shadow:var(--shadow3);opacity:0;transform:translateY(-8px);pointer-events:none;transition:all var(--base) var(--ease);z-index:999;overflow:hidden}
.sel-drop.open{opacity:1;transform:translateY(0);pointer-events:all}
.sel-opt{padding:12px 16px;font-size:13px;color:var(--text);cursor:pointer;display:flex;align-items:center;gap:9px;transition:background var(--fast) var(--ease)}
.sel-opt:hover{background:var(--surface2)}
.sel-opt.on{color:var(--teal);font-weight:600}
.sel-dot{width:7px;height:7px;border-radius:50%;background:var(--text3);flex-shrink:0}
.sel-opt.on .sel-dot{background:var(--teal)}
#modelHidden{display:none}

/* ════════════════════════════════════════════════
   MESSAGES
════════════════════════════════════════════════ */
.msgs{flex:1;overflow-y:auto;overflow-x:hidden;padding:32px 20px;scroll-behavior:smooth}
.msgs-inner{width:100%;max-width:780px;margin:0 auto;display:flex;flex-direction:column;gap:20px;min-height:100%}
.msgs::-webkit-scrollbar{width:6px}
.msgs::-webkit-scrollbar-thumb{background:var(--surface3);border-radius:4px}

/* WELCOME */
.welcome{flex:1;display:flex;flex-direction:column;align-items:center;justify-content:center;text-align:center;padding:40px 20px;max-width:780px;margin:0 auto;width:100%}
.welcome-pulse{
  width:88px;height:88px;border-radius:24px;
  background:linear-gradient(135deg,var(--teal),var(--teal3));
  display:flex;align-items:center;justify-content:center;
  margin-bottom:26px;box-shadow:0 8px 32px rgba(14,165,160,.3);
  animation:heartbeat 2.4s ease-in-out infinite;
}
.welcome-pulse svg{width:46px;height:46px;color:#fff}
@keyframes heartbeat{0%,100%{transform:scale(1);box-shadow:0 8px 32px rgba(14,165,160,.3)}50%{transform:scale(1.04);box-shadow:0 12px 48px rgba(14,165,160,.5)}}
.welcome h1{font-family:'DM Serif Display',serif;font-size:clamp(26px,4.5vw,40px);color:var(--text);margin-bottom:10px;line-height:1.2;letter-spacing:-.01em}
.welcome h1 em{font-style:italic;color:var(--teal)}
.welcome-sub{font-size:15px;color:var(--text2);line-height:1.7;max-width:540px;margin-bottom:10px}

/* Medical disclaimer box on welcome */
.welcome-disclaimer{
  display:flex;align-items:flex-start;gap:10px;
  padding:12px 16px;background:rgba(217,119,6,.06);border:1px solid rgba(217,119,6,.2);
  border-radius:var(--r-md);max-width:580px;text-align:left;margin-bottom:32px;
}
.welcome-disclaimer svg{width:16px;height:16px;color:var(--amber);flex-shrink:0;margin-top:2px}
.welcome-disclaimer p{font-size:12.5px;color:var(--text2);line-height:1.55}
.welcome-disclaimer strong{color:var(--amber)}

/* Suggestion cards */
.sug-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:10px;width:100%;max-width:600px}
.sug-card{
  padding:14px 16px;background:var(--surface);
  border:1px solid var(--border);border-radius:var(--r-md);
  cursor:pointer;text-align:left;font-family:inherit;
  transition:all var(--base) var(--ease);
  display:flex;align-items:flex-start;gap:10px;
}
.sug-card:hover{background:var(--surface2);border-color:var(--teal);transform:translateY(-2px);box-shadow:var(--shadow)}
.sug-icon{font-size:20px;flex-shrink:0;line-height:1}
.sug-text strong{display:block;font-size:13px;font-weight:600;color:var(--text);margin-bottom:2px}
.sug-text span{font-size:12.5px;color:var(--text2);line-height:1.4}

/* ════════════════════════════════════════════════
   MESSAGE BUBBLES
════════════════════════════════════════════════ */
.msg{
  display:inline-block;width:fit-content;max-width:84%;
  padding:14px 20px;border-radius:20px;
  font-size:15px;line-height:1.75;word-wrap:break-word;
  animation:msgIn .3s var(--ease);position:relative;
}
@keyframes msgIn{from{opacity:0;transform:translateY(8px)}to{opacity:1;transform:translateY(0)}}

/* User messages — clean teal */
.msg.user{
  align-self:flex-end;
  background:linear-gradient(135deg,var(--teal),var(--teal3));
  color:#fff;border:none;
}
/* AI messages — white card */
.msg.bot{
  align-self:flex-start;background:var(--surface);
  color:var(--text);border:1px solid var(--border2);
  padding-right:52px;
  box-shadow:var(--shadow);
}
/* AI label */
.msg.bot::before{
  content:'MediMind';
  display:block;font-size:10.5px;font-weight:700;color:var(--teal);
  letter-spacing:.05em;text-transform:uppercase;margin-bottom:8px;
  display:flex;align-items:center;gap:5px;
}

.msg-content{min-width:0;display:block;line-height:inherit}
.user .msg-content{white-space:pre-wrap;overflow-wrap:anywhere;word-break:break-word}

.msg-copy{position:absolute;top:10px;right:10px;width:28px;height:28px;border:none;background:var(--surface2);border-radius:6px;color:var(--text2);font-size:10.5px;font-weight:600;cursor:pointer;opacity:0;transition:all var(--base) var(--ease);display:flex;align-items:center;justify-content:center}
.msg.bot:hover .msg-copy{opacity:1}
.msg-copy:hover{background:var(--teal);color:#fff}

/* Bot markdown */
.bot h1,.bot h2,.bot h3,.bot h4{margin-top:22px;margin-bottom:10px;font-weight:700;line-height:1.35;color:var(--text)}
.bot h1:first-child,.bot h2:first-child,.bot h3:first-child{margin-top:0}
.bot h1{font-size:1.6em;font-family:'DM Serif Display',serif}
.bot h2{font-size:1.3em}.bot h3{font-size:1.15em}.bot h4{font-size:1.05em}
.bot hr{border:none;border-top:1px solid var(--border);margin:20px 0}
.bot p{margin:12px 0;line-height:1.8}.bot p:first-child{margin-top:0}.bot p:last-child{margin-bottom:0}
.bot strong{font-weight:700;color:var(--text)}
.bot ul,.bot ol{margin:12px 0;padding-left:26px;line-height:1.8}
.bot li{margin:6px 0}.bot li::marker{color:var(--teal)}
.bot code:not(pre code){background:rgba(14,165,160,.10);padding:2px 7px;border-radius:6px;font-family:'JetBrains Mono',monospace;font-size:.87em;color:var(--teal3);border:1px solid rgba(14,165,160,.2)}
.bot pre{position:relative;background:#1a2e2e;padding:0;border-radius:14px;overflow:hidden;margin:18px 0;border:1px solid rgba(14,165,160,.2);box-shadow:var(--shadow);transition:transform var(--base) var(--ease)}
.bot pre:hover{transform:translateY(-1px);box-shadow:var(--shadow2)}
.bot pre code{display:block;background:none;padding:18px;padding-top:38px;color:#a8d8d8;font-family:'JetBrains Mono',monospace;font-size:13.5px;line-height:1.6;overflow-x:auto;border:none}
.bot pre::before{content:attr(data-lang);position:absolute;top:0;left:0;background:rgba(14,165,160,.15);color:rgba(168,216,216,.8);font-size:10.5px;font-weight:700;padding:7px 14px;letter-spacing:.06em;text-transform:uppercase;font-family:'DM Sans',sans-serif;z-index:1;border-bottom-right-radius:10px}
.bot pre .ccopy{position:absolute;top:6px;right:8px;width:30px;height:30px;border:none;background:rgba(14,165,160,.15);border-radius:6px;color:rgba(168,216,216,.8);cursor:pointer;opacity:0;transition:all var(--base) var(--ease);display:flex;align-items:center;justify-content:center;z-index:2;font-size:13px}
.bot pre:hover .ccopy{opacity:1}
.bot pre .ccopy:hover{background:var(--teal);color:#fff}
.bot blockquote{border-left:3px solid var(--teal);padding:12px 16px;margin:16px 0;background:var(--teal-light);border-radius:0 10px 10px 0;color:var(--text2);font-style:italic;line-height:1.75}
.bot table{width:100%;border-collapse:collapse;margin:16px 0;border:1px solid var(--border);border-radius:12px;overflow:hidden;box-shadow:var(--shadow)}
.bot th,.bot td{padding:10px 14px;text-align:left;border-bottom:1px solid var(--border)}
.bot th{background:var(--teal-light);font-weight:700;color:var(--teal3)}
.bot tr:last-child td{border-bottom:none}
.bot tr:hover td{background:var(--surface2)}

/* Inline medical disclaimer in bot messages */
.med-disclaimer{
  margin-top:14px;padding:10px 13px;
  background:rgba(217,119,6,.06);border:1px solid rgba(217,119,6,.18);
  border-radius:var(--r-sm);font-size:12px;color:var(--text2);line-height:1.55;
  display:flex;align-items:flex-start;gap:8px;
}
.med-disclaimer-icon{font-size:13px;flex-shrink:0}

/* Emergency alert in bot messages */
.emerg-alert{
  margin-top:14px;padding:10px 13px;
  background:rgba(220,38,38,.07);border:1px solid rgba(220,38,38,.2);
  border-radius:var(--r-sm);font-size:12.5px;color:var(--red);
  font-weight:600;line-height:1.5;display:flex;align-items:center;gap:8px;
}

/* Math */
.math-block{margin:16px 0;padding:14px 16px;background:var(--teal-light);border:1px solid var(--border2);border-radius:12px;text-align:center;overflow-x:auto}
.math-tex{display:inline-block;font-family:'JetBrains Mono',monospace;font-style:italic;font-size:.95em;line-height:1.65;color:var(--text);white-space:pre}
.math-inline{display:inline-block;padding:1px 6px;border-radius:5px;background:var(--teal-light);border:1px solid var(--border2);font-family:'JetBrains Mono',monospace;font-style:italic;font-size:.9em;color:var(--teal3);white-space:nowrap;vertical-align:baseline}

/* Typing */
.typing{display:flex;align-items:center;gap:9px;color:var(--text2);font-size:14px;padding:14px 20px;background:var(--surface);border:1px solid var(--border2);border-radius:20px;align-self:flex-start;box-shadow:var(--shadow)}
.typing-label{color:var(--teal);font-weight:600;font-size:13px}
.typing-dots{display:flex;gap:4px}
.typing-dots span{width:6px;height:6px;border-radius:50%;background:var(--teal);opacity:.4;animation:td 1.4s infinite ease-in-out}
.typing-dots span:nth-child(1){animation-delay:-.32s}.typing-dots span:nth-child(2){animation-delay:-.16s}
@keyframes td{0%,80%,100%{transform:scale(.8);opacity:.35}40%{transform:scale(1.1);opacity:1}}

/* ════════════════════════════════════════════════
   INPUT BAR
════════════════════════════════════════════════ */
.input-bar{
  padding:14px 20px;background:var(--bg2);
  border-top:1px solid var(--border);flex-shrink:0;
  box-shadow:0 -4px 24px rgba(14,165,160,.07);
}
.input-wrap{
  max-width:780px;margin:0 auto;
  display:flex;align-items:flex-end;gap:8px;
  background:var(--surface);border:1px solid var(--border2);
  border-radius:22px;padding:8px 10px;
  transition:all var(--base) var(--ease);box-shadow:var(--shadow);
}
.input-wrap:focus-within{border-color:var(--teal);box-shadow:0 0 0 3px var(--teal-glow),var(--shadow)}
.ibtn{width:36px;height:36px;border:none;background:transparent;border-radius:10px;color:var(--text2);cursor:pointer;display:flex;align-items:center;justify-content:center;transition:all var(--base) var(--ease);flex-shrink:0}
.ibtn:hover{background:var(--surface2);color:var(--teal)}
.ibtn svg{width:17px;height:17px}
.ibtn.send{background:var(--teal);color:#fff;box-shadow:0 3px 12px rgba(14,165,160,.35)}
.ibtn.send:hover{background:var(--teal2);transform:translateY(-1px);box-shadow:0 5px 20px rgba(14,165,160,.5)}
.ibtn.send:disabled{opacity:.5;cursor:not-allowed;transform:none;box-shadow:none}
textarea{flex:1;background:transparent;border:none;color:var(--text);font-family:inherit;font-size:15px;line-height:1.5;resize:none;outline:none;min-height:36px;max-height:200px;padding:8px 4px;scrollbar-width:none}
textarea::placeholder{color:var(--text3)}
textarea::-webkit-scrollbar{width:0}

.input-hint{
  text-align:center;font-size:11.5px;color:var(--text3);
  margin-top:9px;max-width:780px;margin-left:auto;margin-right:auto;
  display:flex;align-items:center;justify-content:center;gap:8px;
}
.hint-badge{
  display:inline-flex;align-items:center;gap:4px;
  padding:3px 8px;background:rgba(14,165,160,.08);border:1px solid var(--border);
  border-radius:20px;font-size:10.5px;font-weight:600;color:var(--teal3);
}

/* ════════════════════════════════════════════════
   PROFILE MODAL
════════════════════════════════════════════════ */
.modal-mask{position:fixed;inset:0;z-index:5000;background:rgba(15,32,39,.5);backdrop-filter:blur(8px);display:none;align-items:center;justify-content:center;padding:20px}
.modal-mask.open{display:flex}
.modal{width:100%;max-width:400px;background:var(--bg2);border:1px solid var(--border2);border-radius:var(--r-xl);padding:32px 28px;box-shadow:var(--shadow3);animation:authSlide .3s var(--ease)}
.modal-hdr{display:flex;align-items:center;justify-content:space-between;margin-bottom:22px}
.modal-title{font-family:'DM Serif Display',serif;font-size:22px;color:var(--text)}
.modal-x{width:32px;height:32px;border:1px solid var(--border);background:var(--bg3);border-radius:8px;color:var(--text2);cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:15px;transition:all var(--fast) var(--ease)}
.modal-x:hover{background:rgba(220,38,38,.08);border-color:rgba(220,38,38,.2);color:var(--red)}
.modal form{display:flex;flex-direction:column;gap:14px}
.color-row{display:flex;gap:8px;flex-wrap:wrap;margin-top:4px}
.cdot{width:28px;height:28px;border-radius:50%;cursor:pointer;border:2px solid transparent;transition:all var(--fast) var(--ease)}
.cdot.on,.cdot:hover{border-color:var(--text);transform:scale(1.18)}

/* Sidebar overlay mobile */
.side-mask{display:none;position:fixed;inset:0;background:rgba(0,0,0,.4);z-index:99;backdrop-filter:blur(3px)}
.side-mask.on{display:block}

/* ════════════════════════════════════════════════
   RESPONSIVE
════════════════════════════════════════════════ */
@media(max-width:768px){
  .sidebar{position:fixed;top:0;left:0;bottom:0;width:280px;max-width:88vw;box-shadow:4px 0 32px rgba(14,165,160,.15);transform:translateX(-100%)}
  .sidebar.open{transform:translateX(0)}
  .mob-hdr{display:flex}
  .msgs{padding:20px 12px}
  .msgs-inner{gap:15px}
  .msg{max-width:93%;padding:11px 14px;font-size:14.5px}
  .input-bar{padding:10px 12px;padding-bottom:max(10px,env(safe-area-inset-bottom))}
  .input-wrap{padding:6px 8px;border-radius:18px}
  .ibtn{width:33px;height:33px}
  .welcome h1{font-size:24px}
  .sug-grid{grid-template-columns:1fr}
  .model-bar{top:12px;right:12px}
  .auth-left{padding:28px 24px}
}
@media(min-width:769px){.msgs{padding:36px 28px}}
@media(prefers-reduced-motion:reduce){*{animation:none!important;transition:none!important}}
  </style>
</head>
<body>

<!-- ══════════════════════════════════════════
     AUTH PAGE
══════════════════════════════════════════ -->
<div id="authOverlay">
  <!-- Left branding panel -->
  <div class="auth-left">
    <div class="auth-brand">
      <div class="auth-logo-icon" style="width:64px;height:64px;background:rgba(255,255,255,.2);border-radius:20px;display:flex;align-items:center;justify-content:center;margin-bottom:28px;border:1px solid rgba(255,255,255,.3)">
        <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1.8" width="36" height="36"><path d="M12 2a10 10 0 1 0 0 20 10 10 0 0 0 0-20zM12 8v4M12 16h.01"/><path d="M8 12h8M12 8v8"/></svg>
      </div>
      <h1>Medi<em>Mind</em></h1>
      <p>Your trusted AI healthcare assistant — providing evidence-based medical information, wellness guidance, and compassionate health support.</p>
      <div class="auth-features">
        <div class="auth-feature"><div class="auth-feature-dot">🩺</div><span>Symptom information & guidance</span></div>
        <div class="auth-feature"><div class="auth-feature-dot">💊</div><span>Medication & treatment info</span></div>
        <div class="auth-feature"><div class="auth-feature-dot">🧠</div><span>Mental health support & resources</span></div>
        <div class="auth-feature"><div class="auth-feature-dot">❤️</div><span>Preventive care & wellness tips</span></div>
        <div class="auth-feature"><div class="auth-feature-dot">🏥</div><span>Healthcare navigation & advice</span></div>
      </div>
    </div>
  </div>

  <!-- Right form panel -->
  <div class="auth-right">
    <div class="auth-card">
      <div class="auth-card-title">Welcome to MediMind</div>
      <div class="auth-card-sub">Sign in to access your personal health AI assistant</div>

      <div class="auth-tabs">
        <button class="auth-tab on" id="tabLogin" onclick="switchTab('login')">Sign In</button>
        <button class="auth-tab" id="tabReg" onclick="switchTab('register')">Create Account</button>
      </div>

      <!-- Login -->
      <div id="formLogin">
        <div class="auth-msg err" id="loginErr"></div>
        <div class="auth-form">
          <div>
            <label class="auth-label">Email or Username</label>
            <input class="auth-input" id="loginLogin" type="text" placeholder="your@email.com" autocomplete="username"/>
          </div>
          <div>
            <label class="auth-label">Password</label>
            <input class="auth-input" id="loginPwd" type="password" placeholder="••••••••" autocomplete="current-password"/>
          </div>
          <button class="auth-btn" id="loginBtn" onclick="doLogin()">Sign In →</button>
        </div>
      </div>

      <!-- Register -->
      <div id="formReg" style="display:none">
        <div class="auth-msg err" id="regErr"></div>
        <div class="auth-msg ok" id="regOk"></div>
        <div class="auth-form">
          <div class="two-col">
            <div>
              <label class="auth-label">Username</label>
              <input class="auth-input" id="regUsername" type="text" placeholder="janesmith" autocomplete="username"/>
            </div>
            <div>
              <label class="auth-label">Full Name</label>
              <input class="auth-input" id="regDisplay" type="text" placeholder="Jane Smith"/>
            </div>
          </div>
          <div>
            <label class="auth-label">Email Address</label>
            <input class="auth-input" id="regEmail" type="email" placeholder="jane@example.com" autocomplete="email"/>
          </div>
          <div>
            <label class="auth-label">Password</label>
            <input class="auth-input" id="regPwd" type="password" placeholder="Minimum 6 characters" autocomplete="new-password"/>
          </div>
          <button class="auth-btn" id="regBtn" onclick="doRegister()">Create Account →</button>
        </div>
      </div>

      <div class="auth-disclaimer">
        <strong>⚕️ Medical Disclaimer:</strong> MediMind provides general health information only. It does not replace professional medical advice, diagnosis, or treatment. Always consult a qualified healthcare provider for personal medical concerns.
      </div>
    </div>
  </div>
</div>

<!-- ══════════════════════════════════════════
     MAIN APP SHELL
══════════════════════════════════════════ -->
<div id="appShell" class="hidden">

  <!-- Sidebar -->
  <aside class="sidebar" id="sidebar">
    <div class="sidebar-top">
      <div class="sidebar-brand">
        <div class="brand-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2a10 10 0 1 0 0 20 10 10 0 0 0 0-20z"/><path d="M8 12h8M12 8v8"/></svg>
        </div>
        <div class="brand-name">Medi<em>Mind</em></div>
      </div>
      <button class="nc-btn" id="newChatBtn">
        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2"><path d="M8 3v10M3 8h10"/></svg>
        New Consultation
      </button>
    </div>

    <div class="chat-scroll" id="chatList"></div>

    <div class="sidebar-bottom">
      <div class="user-panel" id="userPanel" onclick="openProfile()">
        <div class="user-av" id="userAv">?</div>
        <div class="user-info">
          <div class="user-name" id="userName">—</div>
          <div class="user-role">Healthcare Patient</div>
        </div>
        <span class="user-gear">⚙</span>
      </div>
      <button class="logout-btn" onclick="doLogout()">
        <svg width="13" height="13" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2"><path d="M10 2h3a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1h-3M6 11l-4-3 4-3M2 8h8"/></svg>
        Sign Out
      </button>
    </div>
  </aside>

  <div class="side-mask" id="sideMask"></div>

  <!-- Main content -->
  <main class="main">
    <!-- Mobile header -->
    <div class="mob-hdr" id="mobHdr">
      <button class="ham" id="hamBtn">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 12h18M3 6h18M3 18h18"/></svg>
      </button>
      <h1>
        <div class="mob-brand-icon"><svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" width="17" height="17"><path d="M8 12h8M12 8v8"/><circle cx="12" cy="12" r="9"/></svg></div>
        MediMind
      </h1>
    </div>

    <!-- Model selector -->
    <div class="model-bar">
      <button class="sel-btn" id="selBtn">
        <span id="selLabel">⚡ Flash Mode</span>
        <span style="font-size:10px;opacity:.5">▾</span>
      </button>
      <div class="sel-drop" id="selDrop">
        <div class="sel-opt on" data-value="LongCat-Flash-Chat"><span class="sel-dot"></span>⚡ Flash Mode<span style="font-size:10.5px;color:var(--text3);margin-left:auto">Fast</span></div>
        <div class="sel-opt" data-value="LongCat-Flash-Thinking"><span class="sel-dot"></span>🧬 Clinical Mode<span style="font-size:10.5px;color:var(--text3);margin-left:auto">Deep</span></div>
        <div class="sel-opt" data-value="LongCat-Flash-Thinking-2601"><span class="sel-dot"></span>🔬 Research Mode<span style="font-size:10.5px;color:var(--text3);margin-left:auto">Advanced</span></div>
      </div>
      <input type="hidden" id="modelHidden" value="LongCat-Flash-Chat"/>
    </div>

    <!-- Messages -->
    <div class="msgs" id="msgs">
      <div class="msgs-inner" id="msgsInner"></div>
    </div>

    <!-- Input bar -->
    <div class="input-bar">
      <div class="input-wrap">
        <button class="ibtn" id="newChatInline" title="New consultation">
          <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2"><path d="M8 3v10M3 8h10"/></svg>
        </button>
        <textarea id="chatInput" placeholder="Ask about symptoms, medications, wellness, or any health concern…" rows="1"></textarea>
        <button class="ibtn send" id="sendBtn" title="Send">
          <svg viewBox="0 0 16 16" fill="currentColor"><path d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H2.5a.5.5 0 0 0 0 1h11.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/></svg>
        </button>
      </div>
      <div class="input-hint">
        <span class="hint-badge">⚕️ Healthcare Only</span>
        MediMind provides general health information. Always consult a doctor for personal medical advice.
      </div>
    </div>
  </main>
</div>

<!-- ══════════════════════════════════════════
     PROFILE MODAL
══════════════════════════════════════════ -->
<div class="modal-mask" id="profileModal">
  <div class="modal">
    <div class="modal-hdr">
      <div class="modal-title">My Profile</div>
      <button class="modal-x" onclick="closeProfile()">✕</button>
    </div>
    <form onsubmit="saveProfile(event)">
      <div>
        <label class="auth-label">Display Name</label>
        <input class="auth-input" id="profName" type="text" placeholder="Your Name"/>
      </div>
      <div>
        <label class="auth-label">Avatar Color</label>
        <div class="color-row" id="colorRow"></div>
      </div>
      <div>
        <label class="auth-label">New Password <span style="color:var(--text3);font-size:10px;text-transform:none;letter-spacing:0">(leave blank to keep current)</span></label>
        <input class="auth-input" id="profPwd" type="password" placeholder="••••••••"/>
      </div>
      <div class="auth-msg err" id="profErr"></div>
      <div class="auth-msg ok" id="profOk"></div>
      <button class="auth-btn" type="submit">Save Changes</button>
    </form>
  </div>
</div>

<script>
/* ══════════════════════════════════════════════
   CONFIG
══════════════════════════════════════════════ */
const API = 'api.php';
const AV_COLORS = ['#0ea5a0','#0891b2','#059669','#2563eb','#7c3aed','#db2777','#0f766e','#d97706'];

let authToken   = localStorage.getItem('medimind_token') || '';
let currentUser = null;
let chats       = [];
let activeChatId= null;
let conversation= [];

/* ══════════════════════════════════════════════
   MARKED
══════════════════════════════════════════════ */
if(window.marked) marked.setOptions({gfm:true,breaks:true,headerIds:false,mangle:false});

/* ══════════════════════════════════════════════
   API
══════════════════════════════════════════════ */
async function api(action,method='GET',body=null,params={}){
  const url=new URL(API,location.href);
  url.searchParams.set('action',action);
  Object.entries(params).forEach(([k,v])=>url.searchParams.set(k,v));
  const opts={method,headers:{'Content-Type':'application/json'}};
  if(authToken) opts.headers['X-Auth-Token']=authToken;
  if(body) opts.body=JSON.stringify(body);
  const res=await fetch(url,opts);
  const data=await res.json().catch(()=>({}));
  if(!res.ok) throw new Error(data.error||`HTTP ${res.status}`);
  return data;
}

/* ══════════════════════════════════════════════
   AUTH
══════════════════════════════════════════════ */
function switchTab(tab){
  document.getElementById('formLogin').style.display=tab==='login'?'':'none';
  document.getElementById('formReg').style.display=tab==='register'?'':'none';
  document.getElementById('tabLogin').classList.toggle('on',tab==='login');
  document.getElementById('tabReg').classList.toggle('on',tab==='register');
}

function showMsg(id,msg){const el=document.getElementById(id);el.textContent=msg;el.style.display='block';}
function hideMsg(id){document.getElementById(id).style.display='none';}

async function doLogin(){
  const btn=document.getElementById('loginBtn');
  btn.disabled=true;btn.textContent='Signing in…';hideMsg('loginErr');
  try{
    const res=await api('login','POST',{login:document.getElementById('loginLogin').value.trim(),password:document.getElementById('loginPwd').value});
    authToken=res.token;localStorage.setItem('medimind_token',authToken);currentUser=res.user;bootApp();
  }catch(e){showMsg('loginErr',e.message);btn.disabled=false;btn.textContent='Sign In →';}
}

async function doRegister(){
  const btn=document.getElementById('regBtn');
  btn.disabled=true;btn.textContent='Creating account…';hideMsg('regErr');hideMsg('regOk');
  try{
    const res=await api('register','POST',{
      username:document.getElementById('regUsername').value.trim(),
      email:document.getElementById('regEmail').value.trim(),
      password:document.getElementById('regPwd').value,
      display_name:document.getElementById('regDisplay').value.trim(),
    });
    authToken=res.token;localStorage.setItem('medimind_token',authToken);currentUser=res.user;
    showMsg('regOk','Account created! Loading your health dashboard…');
    setTimeout(bootApp,700);
  }catch(e){showMsg('regErr',e.message);btn.disabled=false;btn.textContent='Create Account →';}
}

function doLogout(){
  api('logout','POST').catch(()=>{});
  authToken='';localStorage.removeItem('medimind_token');
  currentUser=null;chats=[];activeChatId=null;conversation=[];
  document.getElementById('appShell').classList.add('hidden');
  document.getElementById('authOverlay').style.display='flex';
  switchTab('login');
}

/* ══════════════════════════════════════════════
   BOOT
══════════════════════════════════════════════ */
async function bootApp(){
  document.getElementById('authOverlay').style.display='none';
  document.getElementById('appShell').classList.remove('hidden');
  renderUserPanel();await loadChats();
}

function renderUserPanel(){
  if(!currentUser) return;
  const dn=currentUser.display_name||currentUser.username;
  document.getElementById('userName').textContent=dn;
  const av=document.getElementById('userAv');
  av.textContent=dn[0].toUpperCase();
  av.style.background=currentUser.avatar_color||'#0ea5a0';
}

/* ══════════════════════════════════════════════
   CHAT LIST
══════════════════════════════════════════════ */
async function loadChats(){
  try{chats=await api('chats','GET');}catch{chats=[];}
  renderChatList();
  if(chats.length) await loadChat(chats[0].chat_uuid);
  else showWelcome();
}

function renderChatList(){
  const el=document.getElementById('chatList');
  if(!chats.length){
    el.innerHTML='<div style="padding:20px 12px;font-size:13px;color:var(--text3);text-align:center;line-height:1.6">No consultations yet.<br>Ask your first health question!</div>';
    return;
  }
  const now=Date.now(),day=86400000;
  const g={Today:[],Yesterday:[],Earlier:[]};
  chats.forEach(c=>{
    const d=new Date(c.updated_at).getTime();
    if(now-d<day) g.Today.push(c);
    else if(now-d<2*day) g.Yesterday.push(c);
    else g.Earlier.push(c);
  });
  let html='';
  Object.entries(g).forEach(([label,list])=>{
    if(!list.length) return;
    html+=`<div class="sidebar-section"><span class="section-label">${label}</span><div class="section-line"></div></div>`;
    list.forEach(c=>{
      html+=`<div class="chat-item${c.chat_uuid===activeChatId?' active':''}" data-uuid="${c.chat_uuid}">
        <span class="chat-item-ico"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M2 2h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H5l-3 3V3a1 1 0 0 1 1-1z"/></svg></span>
        <span class="chat-item-title">${escHtml(c.title||'New consultation')}</span>
        <button class="chat-item-del" data-uuid="${c.chat_uuid}">✕</button>
      </div>`;
    });
  });
  el.innerHTML=html;

  el.querySelectorAll('.chat-item').forEach(item=>{
    item.addEventListener('click',e=>{
      if(e.target.closest('.chat-item-del')) return;
      loadChat(item.dataset.uuid);
      if(window.innerWidth<=768) closeSidebar();
    });
    const titleEl=item.querySelector('.chat-item-title');
    titleEl.addEventListener('dblclick',e=>{
      e.stopPropagation();
      const inp=document.createElement('input');
      inp.className='chat-title-inp';
      inp.value=chats.find(c=>c.chat_uuid===item.dataset.uuid)?.title||'';
      titleEl.replaceWith(inp);inp.focus();inp.select();
      const save=async()=>{
        const t=inp.value.trim()||'New consultation';
        await api('chat','POST',{title:t},{uuid:item.dataset.uuid}).catch(()=>{});
        const c=chats.find(x=>x.chat_uuid===item.dataset.uuid);if(c) c.title=t;
        renderChatList();
      };
      inp.addEventListener('keydown',e=>{if(e.key==='Enter')save();if(e.key==='Escape')renderChatList();});
      inp.addEventListener('blur',save);
    });
    item.querySelector('.chat-item-del')?.addEventListener('click',async e=>{
      e.stopPropagation();
      if(!confirm('Delete this consultation?')) return;
      const uuid=e.currentTarget.dataset.uuid;
      await api('chat','DELETE',null,{uuid}).catch(()=>{});
      chats=chats.filter(c=>c.chat_uuid!==uuid);
      if(activeChatId===uuid){activeChatId=null;conversation=[];showWelcome();}
      renderChatList();
    });
  });
}

/* ══════════════════════════════════════════════
   WELCOME SCREEN
══════════════════════════════════════════════ */
function showWelcome(){
  const name=currentUser?.display_name||currentUser?.username||'there';
  document.getElementById('msgsInner').innerHTML=`
  <div class="welcome">
    <div class="welcome-pulse">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
      </svg>
    </div>
    <h1>Hello, <em>${escHtml(name)}</em></h1>
    <p class="welcome-sub">I'm MediMind, your dedicated AI healthcare assistant. I can help you understand symptoms, medications, wellness tips, and navigate healthcare — all within the healthcare domain.</p>
    <div class="welcome-disclaimer">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
      <p><strong>Medical Disclaimer:</strong> I provide general health information only — not personal medical advice, diagnosis, or treatment. For personal health concerns, always consult a licensed healthcare professional.</p>
    </div>
    <div class="sug-grid">
      <button class="sug-card" onclick="fillInput(this.dataset.q)" data-q="I have a headache, fever, and sore throat. What could be causing this?">
        <div class="sug-icon">🤒</div>
        <div class="sug-text"><strong>Symptom Checker</strong><span>Understand your symptoms and what they might indicate</span></div>
      </button>
      <button class="sug-card" onclick="fillInput(this.dataset.q)" data-q="What are the common side effects of ibuprofen and when should I avoid taking it?">
        <div class="sug-icon">💊</div>
        <div class="sug-text"><strong>Medication Info</strong><span>Learn about drugs, dosage, and interactions</span></div>
      </button>
      <button class="sug-card" onclick="fillInput(this.dataset.q)" data-q="What lifestyle changes can help manage Type 2 diabetes?">
        <div class="sug-icon">🏃</div>
        <div class="sug-text"><strong>Chronic Disease</strong><span>Management tips for ongoing health conditions</span></div>
      </button>
      <button class="sug-card" onclick="fillInput(this.dataset.q)" data-q="I've been feeling very anxious and stressed lately. What are some effective coping strategies?">
        <div class="sug-icon">🧠</div>
        <div class="sug-text"><strong>Mental Health</strong><span>Support for anxiety, stress, and emotional wellbeing</span></div>
      </button>
    </div>
  </div>`;
}

function fillInput(text){
  document.getElementById('chatInput').value=text;
  document.getElementById('chatInput').dispatchEvent(new Event('input'));
  document.getElementById('chatInput').focus();
}

/* ══════════════════════════════════════════════
   LOAD CHAT
══════════════════════════════════════════════ */
async function loadChat(uuid){
  activeChatId=uuid;conversation=[];
  document.getElementById('msgsInner').innerHTML='';
  renderChatList();
  try{
    const msgs=await api('messages','GET',null,{uuid});
    conversation=msgs.map(m=>({role:m.role,content:m.content}));
    msgs.forEach(m=>addMsg(m.role==='assistant'?'bot':m.role,m.content));
  }catch(e){console.error(e);}
}

/* ══════════════════════════════════════════════
   CREATE CHAT
══════════════════════════════════════════════ */
async function createNewChat(){
  try{
    const c=await api('chats','POST',{title:'New consultation',model:document.getElementById('modelHidden').value});
    chats.unshift(c);activeChatId=c.chat_uuid;conversation=[];showWelcome();renderChatList();
  }catch(e){console.error(e);}
}

/* ══════════════════════════════════════════════
   SEND MESSAGE
══════════════════════════════════════════════ */
async function sendMsg(retry=0){
  const inp=document.getElementById('chatInput');
  const text=inp.value.trim();if(!text) return;
  if(!activeChatId){await createNewChat();if(!activeChatId) return;}
  inp.value='';inp.style.height='auto';
  addMsg('user',text);addTyping();
  document.getElementById('sendBtn').disabled=true;
  try{
    const data=await api('send','POST',{chat_uuid:activeChatId,message:text,model:document.getElementById('modelHidden').value,temperature:0.7});
    removeTyping();addMsg('bot',data.reply);
    conversation=[...conversation,{role:'user',content:text},{role:'assistant',content:data.reply}];
    const c=chats.find(x=>x.chat_uuid===activeChatId);if(c&&data.title) c.title=data.title;
    renderChatList();
  }catch(err){
    removeTyping();
    if(retry<2&&err.message.includes('429')){addTyping();await new Promise(r=>setTimeout(r,2000));return sendMsg(retry+1);}
    addMsg('bot','⚠️ **Connection Error**\n\n'+err.message);console.error(err);
  }
  document.getElementById('sendBtn').disabled=false;inp.focus();
}

/* ══════════════════════════════════════════════
   MESSAGE UI
══════════════════════════════════════════════ */
function addMsg(role,content){
  const inner=document.getElementById('msgsInner');
  inner.querySelector('.welcome')?.remove();
  const div=document.createElement('div');
  div.className=`msg ${role==='user'?'user':'bot'}`;

  if(role!=='user'){
    const san=sanitize(content);
    const wm=mathFmt(san);
    let html;try{html=marked.parse(wm)}catch{html=`<p>${escHtml(san)}</p>`}
    const tmp=document.createElement('div');tmp.innerHTML=html;
    tmp.querySelectorAll('pre').forEach(pre=>{
      const code=pre.querySelector('code');
      const lang=(code?.className?.match(/language-(\S+)/)||[])[1]||'code';
      pre.setAttribute('data-lang',lang);
      const b=document.createElement('button');b.className='ccopy';b.textContent='📋';b.title='Copy';pre.appendChild(b);
    });
    const ce=document.createElement('div');ce.className='msg-content';ce.innerHTML=tmp.innerHTML;div.appendChild(ce);
    const cp=document.createElement('button');cp.className='msg-copy';cp.textContent='Copy';
    cp.onclick=async()=>{try{await navigator.clipboard.writeText(san);cp.textContent='✓';setTimeout(()=>cp.textContent='Copy',2000)}catch{}};
    div.appendChild(cp);
  } else {
    const ce=document.createElement('div');ce.className='msg-content';ce.textContent=content;div.appendChild(ce);
  }
  inner.appendChild(div);
  document.getElementById('msgs').scrollTop=99999;
}

function addTyping(){
  const div=document.createElement('div');div.className='msg bot typing';div.id='typing';
  div.innerHTML='<span class="typing-label">MediMind is thinking</span><div class="typing-dots"><span></span><span></span><span></span></div>';
  document.getElementById('msgsInner').appendChild(div);
  document.getElementById('msgs').scrollTop=99999;
}
function removeTyping(){document.getElementById('typing')?.remove();}

/* ══════════════════════════════════════════════
   PROFILE MODAL
══════════════════════════════════════════════ */
function openProfile(){
  document.getElementById('profName').value=currentUser?.display_name||'';
  document.getElementById('profPwd').value='';
  hideMsg('profErr');hideMsg('profOk');
  const cr=document.getElementById('colorRow');
  cr.innerHTML=AV_COLORS.map(c=>`<div class="cdot${c===currentUser?.avatar_color?' on':''}" style="background:${c}" data-c="${c}"></div>`).join('');
  cr.querySelectorAll('.cdot').forEach(d=>d.addEventListener('click',()=>{cr.querySelectorAll('.cdot').forEach(x=>x.classList.remove('on'));d.classList.add('on');}));
  document.getElementById('profileModal').classList.add('open');
}
function closeProfile(){document.getElementById('profileModal').classList.remove('open');}
async function saveProfile(e){
  e.preventDefault();
  const body={};
  const n=document.getElementById('profName').value.trim();
  const p=document.getElementById('profPwd').value;
  const sel=document.getElementById('colorRow').querySelector('.cdot.on');
  if(n) body.display_name=n;if(p) body.new_password=p;if(sel) body.avatar_color=sel.dataset.c;
  try{
    currentUser=await api('profile','POST',body);renderUserPanel();
    showMsg('profOk','Profile updated successfully!');hideMsg('profErr');
    setTimeout(closeProfile,1400);
  }catch(err){showMsg('profErr',err.message);hideMsg('profOk');}
}

/* ══════════════════════════════════════════════
   SIDEBAR / MOBILE
══════════════════════════════════════════════ */
function closeSidebar(){document.getElementById('sidebar').classList.remove('open');document.getElementById('sideMask').classList.remove('on');}
document.getElementById('hamBtn')?.addEventListener('click',()=>{document.getElementById('sidebar').classList.toggle('open');document.getElementById('sideMask').classList.toggle('on');});
document.getElementById('sideMask').addEventListener('click',closeSidebar);

/* ══════════════════════════════════════════════
   MODEL SELECTOR
══════════════════════════════════════════════ */
const selBtn=document.getElementById('selBtn'),selDrop=document.getElementById('selDrop');
selBtn.addEventListener('click',e=>{e.stopPropagation();selDrop.classList.toggle('open');});
document.addEventListener('click',()=>selDrop.classList.remove('open'));
selDrop.querySelectorAll('.sel-opt').forEach(opt=>{
  opt.addEventListener('click',e=>{
    e.stopPropagation();
    selDrop.querySelectorAll('.sel-opt').forEach(o=>o.classList.remove('on'));
    opt.classList.add('on');
    document.getElementById('selLabel').textContent=opt.textContent.split(/\s{2,}/)[0].trim();
    document.getElementById('modelHidden').value=opt.dataset.value;
    selDrop.classList.remove('open');
  });
});

/* ══════════════════════════════════════════════
   CODE COPY DELEGATION
══════════════════════════════════════════════ */
document.getElementById('msgsInner').addEventListener('click',async e=>{
  const b=e.target?.closest?.('.ccopy');if(!b) return;
  e.preventDefault();e.stopPropagation();
  const code=b.closest('pre')?.querySelector('code');if(!code) return;
  try{await navigator.clipboard.writeText(code.textContent);b.textContent='✓';setTimeout(()=>b.innerHTML='📋',1200);}
  catch{const ta=document.createElement('textarea');ta.value=code.textContent;ta.style='position:fixed;left:-9999px';document.body.appendChild(ta);ta.select();document.execCommand('copy');ta.remove();b.textContent='✓';setTimeout(()=>b.innerHTML='📋',1200);}
});

/* ══════════════════════════════════════════════
   INPUT
══════════════════════════════════════════════ */
document.getElementById('chatInput').addEventListener('input',function(){this.style.height='auto';this.style.height=Math.min(this.scrollHeight,200)+'px';});
document.getElementById('sendBtn').onclick=sendMsg;
document.getElementById('chatInput').addEventListener('keydown',e=>{if(e.key==='Enter'&&!e.shiftKey){e.preventDefault();sendMsg();}});
document.getElementById('newChatBtn').addEventListener('click',createNewChat);
document.getElementById('newChatInline').addEventListener('click',()=>{createNewChat();document.getElementById('chatInput').focus();});

/* ══════════════════════════════════════════════
   AUTH ENTER KEY
══════════════════════════════════════════════ */
['loginLogin','loginPwd'].forEach(id=>document.getElementById(id).addEventListener('keydown',e=>{if(e.key==='Enter')doLogin();}));
['regUsername','regEmail','regPwd','regDisplay'].forEach(id=>document.getElementById(id).addEventListener('keydown',e=>{if(e.key==='Enter')doRegister();}));

/* ══════════════════════════════════════════════
   TEXT HELPERS
══════════════════════════════════════════════ */
function sanitize(t){
  if(typeof t!=='string') return '';
  try{t=t.normalize('NFKC')}catch{}
  t=t.replace(/<\|[^>]+\|>/g,'').replace(/\u00A0/g,' ')
    .replace(/\u00C2(?=\s)/g,'').replace(/â€™/g,"'").replace(/â€˜/g,"'")
    .replace(/â€œ/g,'\u201c').replace(/â€\u009D|â€/g,'\u201d')
    .replace(/â€"/g,'\u2013').replace(/â€"/g,'\u2014')
    .replace(/â€¢/g,'\u2022').replace(/â€¦/g,'\u2026');
  t=t.replace(/[\u00AD\u200B-\u200F\u202A-\u202E\u2060\u2066-\u2069\uFEFF]/g,'');
  t=t.replace(/[\u0000-\u0008\u000B\u000C\u000E-\u001F\u007F]/g,'');
  t=t.replace(/^\s*(assistant|bot|medimind)\s*:\s*/i,'');
  if(t.includes('\\n')&&!t.includes('\n')) t=t.replace(/\\n/g,'\n');
  t=t.replace(/\r\n/g,'\n').replace(/\n{4,}/g,'\n\n\n').replace(/\uFFFD+/g,'');
  return t.trim();
}
function escHtml(s){return String(s).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;').replace(/'/g,'&#039;')}
function pTeX(tex){
  if(!tex) return '';let t=String(tex);
  t=t.replace(/\\left/g,'').replace(/\\right/g,'').replace(/\\,|\\;|\\:|\\!|\\quad|\\qquad/g,' ');
  t=t.replace(/\\int\b/g,'∫').replace(/\\cdot\b/g,'·').replace(/\\times\b/g,'×').replace(/\\pm\b/g,'±').replace(/\\le\b/g,'≤').replace(/\\ge\b/g,'≥').replace(/\\neq\b/g,'≠').replace(/\\infty\b/g,'∞');
  t=t.replace(/\\alpha\b/g,'α').replace(/\\beta\b/g,'β').replace(/\\gamma\b/g,'γ').replace(/\\delta\b/g,'δ').replace(/\\pi\b/g,'π').replace(/\\sigma\b/g,'σ');
  t=t.replace(/\\sqrt\s*\{\s*([^{}]+?)\s*\}/g,'√($1)');
  t=t.replace(/\\frac\s*\{\s*([^{}]+?)\s*\}\s*\{\s*([^{}]+?)\s*\}/g,'($1)/($2)');
  t=t.replace(/\^\{([^{}]+)\}/g,'^$1').replace(/_\{([^{}]+)\}/g,'_$1').replace(/[{}]/g,'').replace(/[ \t]{2,}/g,' ').trim();
  return t;
}
function mathFmt(text){
  if(!text) return '';
  let o=text.replace(/\$\$([\s\S]*?)\$\$/g,(_,b)=>`\n<div class="math-block"><span class="math-tex">${escHtml(pTeX(b.trim()))}</span></div>\n`);
  o=o.replace(/\\\[((?:.|\n)*?)\\\]/g,(_,b)=>`\n<div class="math-block"><span class="math-tex">${escHtml(pTeX(b.trim()))}</span></div>\n`);
  o=o.replace(/\\\(([^)]*?)\\\)/g,(_,b)=>`<span class="math-inline">${escHtml(pTeX(b.trim()))}</span>`);
  return o;
}

/* ══════════════════════════════════════════════
   INIT
══════════════════════════════════════════════ */
(async()=>{
  if(authToken){
    try{currentUser=await api('me','GET');bootApp();return;}
    catch{authToken='';localStorage.removeItem('medimind_token');}
  }
  document.getElementById('authOverlay').style.display='flex';
})();
</script>
</body>
</html>
