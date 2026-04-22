<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>MediCare – Health & Wellness Hub</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;900&family=DM+Sans:ital,wght@0,300;0,400;0,500;0,600;1,400&display=swap" rel="stylesheet">
<style>
/* ══════════════════════════════════════════
   THEME VARIABLES
══════════════════════════════════════════ */
:root {
  --teal:        #00c4b3;
  --teal-d:      #009e90;
  --teal-glow:   rgba(0,196,179,0.18);
  --accent:      #ff6b6b;
  --gold:        #ffc947;
  --transition:  0.35s cubic-bezier(0.4,0,0.2,1);
  --radius-lg:   20px;
  --radius-md:   14px;
  --radius-sm:   10px;
  --shadow:      0 8px 40px rgba(0,0,0,0.25);
}
[data-theme="dark"] {
  --bg:          #080f1e;
  --bg-card:     #0d1b31;
  --bg-card2:    #111f38;
  --bg-nav:      rgba(8,15,30,0.88);
  --border:      rgba(255,255,255,0.08);
  --border-t:    rgba(0,196,179,0.25);
  --text:        #e8f1f8;
  --text-muted:  #7a95ad;
  --text-sub:    #4e6a80;
  --input-bg:    #0a1525;
  --tag-bg:      rgba(0,196,179,0.1);
}
[data-theme="light"] {
  --bg:          #f3f7fb;
  --bg-card:     #ffffff;
  --bg-card2:    #eaf3f8;
  --bg-nav:      rgba(255,255,255,0.92);
  --border:      rgba(0,0,0,0.08);
  --border-t:    rgba(0,156,144,0.3);
  --text:        #0d1b2e;
  --text-muted:  #4a6278;
  --text-sub:    #8aacbe;
  --input-bg:    #eef4f8;
  --tag-bg:      rgba(0,156,144,0.1);
}

/* ══════════════════════════════════════════
   RESET & BASE
══════════════════════════════════════════ */
*{margin:0;padding:0;box-sizing:border-box}
html{scroll-behavior:smooth}
body{font-family:'DM Sans',sans-serif;background:var(--bg);color:var(--text);overflow-x:hidden;transition:background .35s,color .35s}
img{max-width:100%;display:block}
a{text-decoration:none;color:inherit}

/* ══════════════════════════════════════════
   SCROLLBAR
══════════════════════════════════════════ */
::-webkit-scrollbar{width:6px}
::-webkit-scrollbar-track{background:transparent}
::-webkit-scrollbar-thumb{background:var(--teal-d);border-radius:4px}

/* ══════════════════════════════════════════
   NAV
══════════════════════════════════════════ */
nav{position:fixed;top:0;width:100%;z-index:900;height:68px;display:flex;align-items:center;padding:0 40px;gap:24px;background:var(--bg-nav);border-bottom:1px solid var(--border);backdrop-filter:blur(24px);transition:background .35s,border .35s}
.logo{font-family:'Playfair Display',serif;font-size:1.45rem;font-weight:900;background:linear-gradient(135deg,var(--teal),#4dffd2);-webkit-background-clip:text;-webkit-text-fill-color:transparent;white-space:nowrap;flex-shrink:0}
.nav-links{display:flex;gap:4px;list-style:none;flex:1}
.nav-links a{color:var(--text-muted);padding:7px 14px;border-radius:8px;font-size:0.875rem;font-weight:500;cursor:pointer;transition:var(--transition);white-space:nowrap}
.nav-links a:hover,.nav-links a.active{color:var(--text);background:var(--teal-glow)}
.nav-right{display:flex;align-items:center;gap:12px;flex-shrink:0}

/* Theme Toggle */
.theme-toggle{width:52px;height:28px;border-radius:14px;background:var(--bg-card2);border:1px solid var(--border);cursor:pointer;position:relative;transition:var(--transition);flex-shrink:0}
.theme-toggle::after{content:'';position:absolute;top:3px;left:3px;width:20px;height:20px;border-radius:50%;background:var(--teal);transition:transform .3s ease;display:flex;align-items:center;justify-content:center}
[data-theme="light"] .theme-toggle::after{transform:translateX(24px);background:var(--gold)}
.theme-icon{font-size:1.1rem;background:none;border:none;cursor:pointer;color:var(--text-muted);padding:4px;transition:var(--transition)}
.theme-icon:hover{color:var(--text)}

/* ══════════════════════════════════════════
   PAGES
══════════════════════════════════════════ */
.page{display:none;min-height:100vh;padding-top:68px;animation:pageIn .45s ease}
.page.active{display:block}
@keyframes pageIn{from{opacity:0;transform:translateY(16px)}to{opacity:1;transform:translateY(0)}}

/* ══════════════════════════════════════════
   HERO – HOME
══════════════════════════════════════════ */
.hero{display:grid;grid-template-columns:1fr 1fr;gap:0;min-height:calc(100vh - 68px);align-items:stretch;overflow:hidden}
.hero-left{padding:80px 60px 60px;display:flex;flex-direction:column;justify-content:center;position:relative}
.hero-left::before{content:'';position:absolute;top:-100px;left:-100px;width:500px;height:500px;border-radius:50%;background:radial-gradient(circle,rgba(0,196,179,0.07),transparent 70%);pointer-events:none}
.hero-right{position:relative;overflow:hidden}
.hero-right img{width:100%;height:100%;object-fit:cover;object-position:center top}
.hero-right::after{content:'';position:absolute;inset:0;background:linear-gradient(90deg,var(--bg) 0%,transparent 30%,transparent 70%,var(--bg) 100%),linear-gradient(to top,var(--bg) 0%,transparent 25%)}
.hero-badge{display:inline-flex;align-items:center;gap:8px;background:var(--teal-glow);border:1px solid var(--border-t);border-radius:30px;padding:5px 16px;font-size:0.8rem;color:var(--teal);font-weight:600;margin-bottom:24px;width:fit-content}
.hero-badge span{width:7px;height:7px;border-radius:50%;background:var(--teal);animation:blink 2s infinite}
@keyframes blink{0%,100%{opacity:1}50%{opacity:0.2}}
.hero h1{font-family:'Playfair Display',serif;font-size:clamp(2.4rem,4.5vw,4rem);font-weight:900;line-height:1.1;margin-bottom:20px}
.hero h1 em{font-style:normal;background:linear-gradient(135deg,var(--teal),#4dffd2);-webkit-background-clip:text;-webkit-text-fill-color:transparent}
.hero-desc{color:var(--text-muted);font-size:1.05rem;line-height:1.75;margin-bottom:36px;max-width:460px}
.hero-cta-row{display:flex;gap:14px;flex-wrap:wrap}
.btn-p{background:linear-gradient(135deg,var(--teal),var(--teal-d));color:#fff;padding:13px 30px;border-radius:12px;font-weight:600;font-size:0.95rem;border:none;cursor:pointer;transition:var(--transition);font-family:'DM Sans',sans-serif}
.btn-p:hover{transform:translateY(-2px);box-shadow:0 10px 36px rgba(0,196,179,0.35)}
.btn-g{background:transparent;color:var(--text);padding:13px 30px;border-radius:12px;font-weight:600;font-size:0.95rem;border:1px solid var(--border);cursor:pointer;transition:var(--transition);font-family:'DM Sans',sans-serif}
.btn-g:hover{border-color:var(--teal);background:var(--teal-glow)}
.stats-bar{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-top:50px;max-width:480px}
.stat-item .num{font-family:'Playfair Display',serif;font-size:2rem;font-weight:900;color:var(--teal);line-height:1}
.stat-item .lbl{color:var(--text-muted);font-size:0.78rem;margin-top:4px}

/* ══════════════════════════════════════════
   SECTION COMMON
══════════════════════════════════════════ */
.section{padding:80px 56px}
.sec-tag{color:var(--teal);font-size:0.75rem;font-weight:700;letter-spacing:3px;text-transform:uppercase;margin-bottom:10px}
.sec-title{font-family:'Playfair Display',serif;font-size:clamp(1.7rem,3vw,2.6rem);font-weight:700;margin-bottom:14px}
.sec-sub{color:var(--text-muted);font-size:0.97rem;line-height:1.75;max-width:520px;margin-bottom:40px}
.sec-head{display:flex;align-items:flex-end;justify-content:space-between;flex-wrap:wrap;gap:20px;margin-bottom:36px}

/* Cards Grid */
.grid-3{display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:24px}
.grid-2{display:grid;grid-template-columns:repeat(auto-fill,minmax(440px,1fr));gap:28px}
.card{background:var(--bg-card);border:1px solid var(--border);border-radius:var(--radius-lg);overflow:hidden;transition:var(--transition);cursor:pointer}
.card:hover{transform:translateY(-5px);border-color:var(--border-t);box-shadow:0 20px 60px rgba(0,0,0,.18)}
.card-img{height:200px;overflow:hidden;position:relative}
.card-img img{width:100%;height:100%;object-fit:cover;transition:transform .5s ease}
.card:hover .card-img img{transform:scale(1.04)}
.card-img-overlay{position:absolute;inset:0;background:linear-gradient(to top,var(--bg-card) 0%,transparent 50%)}
.card-body{padding:24px}
.card-body h3{font-family:'Playfair Display',serif;font-size:1.15rem;margin-bottom:8px}
.card-body p{color:var(--text-muted);font-size:0.87rem;line-height:1.65}
.tag-row{display:flex;gap:8px;flex-wrap:wrap;margin-top:14px}
.tag{background:var(--tag-bg);color:var(--teal);border-radius:20px;padding:3px 12px;font-size:0.74rem;font-weight:600}
.tag.r{background:rgba(255,107,107,.1);color:var(--accent)}
.tag.g{background:rgba(255,201,71,.1);color:var(--gold)}

/* ══════════════════════════════════════════
   FEATURE CARDS (Home)
══════════════════════════════════════════ */
.feat-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:20px;margin-top:16px}
.feat-card{background:var(--bg-card);border:1px solid var(--border);border-radius:var(--radius-lg);padding:28px 24px;text-align:center;transition:var(--transition);cursor:pointer}
.feat-card:hover{border-color:var(--border-t);transform:translateY(-4px);box-shadow:var(--shadow)}
.feat-icon{width:60px;height:60px;border-radius:16px;margin:0 auto 18px;display:flex;align-items:center;justify-content:center;font-size:1.6rem}
.fi-t{background:rgba(0,196,179,.15)}
.fi-r{background:rgba(255,107,107,.15)}
.fi-g{background:rgba(255,201,71,.15)}
.fi-b{background:rgba(102,126,234,.15)}
.feat-card h3{font-size:0.95rem;font-weight:600;margin-bottom:6px}
.feat-card p{color:var(--text-muted);font-size:0.82rem;line-height:1.6}

/* ══════════════════════════════════════════
   DISEASE PAGE
══════════════════════════════════════════ */
.dis-card{background:var(--bg-card);border:1px solid var(--border);border-radius:var(--radius-lg);overflow:hidden;transition:var(--transition)}
.dis-card:hover{transform:translateY(-5px);border-color:var(--border-t);box-shadow:var(--shadow)}
.dis-img{height:180px;overflow:hidden;position:relative}
.dis-img img{width:100%;height:100%;object-fit:cover;transition:transform .5s}
.dis-card:hover .dis-img img{transform:scale(1.06)}
.dis-img-ov{position:absolute;inset:0;background:linear-gradient(to top,var(--bg-card),transparent 55%)}
.dis-body{padding:22px}
.dis-body h3{font-family:'Playfair Display',serif;font-size:1.1rem;margin-bottom:7px}
.dis-body p{color:var(--text-muted);font-size:0.85rem;line-height:1.65}

/* ══════════════════════════════════════════
   MEDICINE PAGE
══════════════════════════════════════════ */
.med-search-bar{display:grid;grid-template-columns:1fr auto auto;gap:12px;margin-bottom:32px;align-items:center}
.search-input{background:var(--input-bg);border:1px solid var(--border);border-radius:12px;padding:13px 20px;color:var(--text);font-size:0.95rem;font-family:'DM Sans',sans-serif;outline:none;transition:var(--transition);width:100%}
.search-input:focus{border-color:var(--teal);box-shadow:0 0 0 3px rgba(0,196,179,.12)}
.search-input::placeholder{color:var(--text-sub)}
select.search-input{cursor:pointer}
.btn-search{background:linear-gradient(135deg,var(--teal),var(--teal-d));border:none;border-radius:12px;padding:13px 28px;color:#fff;font-weight:600;cursor:pointer;font-family:'DM Sans',sans-serif;font-size:0.95rem;transition:var(--transition);white-space:nowrap}
.btn-search:hover{transform:translateY(-2px);box-shadow:0 8px 24px rgba(0,196,179,.3)}

/* Medicine table */
.med-table-wrap{border:1px solid var(--border);border-radius:var(--radius-lg);overflow:hidden}
.med-table{width:100%;border-collapse:collapse;font-size:0.88rem}
.med-table thead{background:var(--bg-card2)}
.med-table th{padding:14px 18px;text-align:left;font-weight:600;font-size:0.8rem;letter-spacing:.5px;text-transform:uppercase;color:var(--text-muted);border-bottom:1px solid var(--border)}
.med-table td{padding:14px 18px;border-bottom:1px solid var(--border);vertical-align:middle;transition:background .2s}
.med-table tbody tr:last-child td{border-bottom:none}
.med-table tbody tr:hover td{background:var(--teal-glow)}
.price-cell{font-weight:700;color:var(--teal);font-family:'Playfair Display',serif;font-size:1rem}
.cat-badge{background:var(--tag-bg);color:var(--teal);border-radius:20px;padding:3px 12px;font-size:0.75rem;font-weight:600;white-space:nowrap}
.generic-name{color:var(--text-muted);font-size:0.82rem;margin-top:2px;font-style:italic}
.med-pagination{display:flex;align-items:center;justify-content:space-between;padding:20px 0 0;flex-wrap:wrap;gap:12px}
.pag-info{color:var(--text-muted);font-size:0.85rem}
.pag-btns{display:flex;gap:8px}
.pag-btn{background:var(--bg-card);border:1px solid var(--border);border-radius:8px;padding:7px 16px;color:var(--text-muted);cursor:pointer;font-size:0.85rem;font-family:'DM Sans',sans-serif;transition:var(--transition)}
.pag-btn:hover,.pag-btn.active{background:var(--teal);border-color:var(--teal);color:#fff}
.pag-btn:disabled{opacity:0.4;cursor:not-allowed}
.no-result{text-align:center;padding:60px 20px;color:var(--text-muted)}
.no-result .icon{font-size:3rem;margin-bottom:12px}
.db-notice{background:rgba(255,201,71,.08);border:1px solid rgba(255,201,71,.2);border-radius:12px;padding:16px 20px;margin-bottom:24px;font-size:0.88rem;color:var(--gold);display:flex;align-items:flex-start;gap:10px}

/* ══════════════════════════════════════════
   PREVENTION PAGE
══════════════════════════════════════════ */
.tips-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(230px,1fr));gap:20px;margin-top:10px}
.tip-card{background:var(--bg-card);border:1px solid var(--border);border-radius:var(--radius-lg);padding:28px;text-align:center;transition:var(--transition)}
.tip-card:hover{transform:translateY(-4px);border-color:var(--border-t)}
.tip-icon{font-size:2.4rem;margin-bottom:14px}
.tip-card h3{font-size:0.95rem;font-weight:600;margin-bottom:8px}
.tip-card p{color:var(--text-muted);font-size:0.83rem;line-height:1.65}
.timeline{padding-left:36px;position:relative;margin-top:10px}
.timeline::before{content:'';position:absolute;left:8px;top:0;bottom:0;width:2px;background:linear-gradient(to bottom,var(--teal),transparent)}
.tl-item{position:relative;margin-bottom:32px}
.tl-dot{position:absolute;left:-32px;top:4px;width:14px;height:14px;border-radius:50%;background:var(--teal);box-shadow:0 0 0 3px var(--teal-glow)}
.tl-card{background:var(--bg-card);border:1px solid var(--border);border-radius:var(--radius-md);padding:22px;transition:var(--transition)}
.tl-card:hover{border-color:var(--border-t);transform:translateX(6px)}
.tl-card h3{font-family:'Playfair Display',serif;font-size:1rem;margin-bottom:7px}
.tl-card p{color:var(--text-muted);font-size:0.85rem;line-height:1.65}

/* Two-col split */
.split{display:grid;grid-template-columns:1fr 1fr;gap:60px;align-items:center}
.split img{width:100%;border-radius:var(--radius-lg);object-fit:cover;height:420px}

/* ══════════════════════════════════════════
   CURE PAGE
══════════════════════════════════════════ */
.tab-row{display:flex;gap:10px;flex-wrap:wrap;margin-bottom:28px}
.tab-btn{background:var(--bg-card);border:1px solid var(--border);border-radius:10px;padding:9px 20px;color:var(--text-muted);cursor:pointer;font-size:0.88rem;font-family:'DM Sans',sans-serif;font-weight:500;transition:var(--transition)}
.tab-btn.active,.tab-btn:hover{background:rgba(0,196,179,.12);border-color:var(--teal);color:var(--text)}
.treatment-panel{display:none}
.treatment-panel.active{display:block}
.treatment-block{background:var(--bg-card);border:1px solid var(--border);border-radius:var(--radius-lg);overflow:hidden}
.tr-item{display:flex;gap:20px;padding:22px;border-bottom:1px solid var(--border);transition:background .2s}
.tr-item:last-child{border-bottom:none}
.tr-item:hover{background:var(--teal-glow)}
.tr-num{width:38px;height:38px;border-radius:10px;background:linear-gradient(135deg,var(--teal),var(--teal-d));display:flex;align-items:center;justify-content:center;font-weight:700;font-size:0.85rem;color:#fff;flex-shrink:0}
.tr-info h4{font-size:0.95rem;font-weight:600;margin-bottom:5px}
.tr-info p{color:var(--text-muted);font-size:0.85rem;line-height:1.65}

/* Cure photo split */
.cure-photo-wrap{border-radius:var(--radius-lg);overflow:hidden;height:400px;position:relative}
.cure-photo-wrap img{width:100%;height:100%;object-fit:cover}
.cure-photo-wrap::after{content:'';position:absolute;inset:0;background:linear-gradient(135deg,rgba(0,196,179,.15),transparent)}

/* ── Cure Hero Banner ── */
.cure-hero{position:relative;width:100%;height:420px;overflow:hidden;display:flex;align-items:center}
.cure-hero-bg{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;object-position:center;filter:brightness(0.55)}
.cure-hero-overlay{position:absolute;inset:0;background:linear-gradient(to bottom,rgba(0,0,0,0.25) 0%,rgba(8,15,30,0.85) 100%)}
[data-theme="light"] .cure-hero-overlay{background:linear-gradient(to bottom,rgba(0,0,0,0.15) 0%,rgba(243,247,251,0.82) 100%)}
.cure-hero-content{position:relative;z-index:2;padding:0 56px;max-width:700px}
.cure-hero-content .sec-tag{color:#4dffd2;margin-bottom:12px}
.cure-hero-content h1{font-family:'Playfair Display',serif;font-size:clamp(2rem,4vw,3.2rem);font-weight:900;line-height:1.15;color:#fff;margin-bottom:16px}
[data-theme="light"] .cure-hero-content h1{color:#0d1b2e}
.cure-hero-content p{color:rgba(255,255,255,0.78);font-size:1rem;line-height:1.75;max-width:520px}
[data-theme="light"] .cure-hero-content p{color:var(--text-muted)}

/* ══════════════════════════════════════════
   ABOUT / DOCTORS
══════════════════════════════════════════ */
.doc-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(240px,1fr));gap:24px}
.doc-card{background:var(--bg-card);border:1px solid var(--border);border-radius:var(--radius-lg);overflow:hidden;text-align:center;transition:var(--transition)}
.doc-card:hover{transform:translateY(-5px);border-color:var(--border-t);box-shadow:var(--shadow)}
.doc-photo{height:240px;overflow:hidden}
.doc-photo img{width:100%;height:100%;object-fit:cover;object-position:center top;transition:transform .5s}
.doc-card:hover .doc-photo img{transform:scale(1.05)}
.doc-info{padding:20px}
.doc-info h3{font-family:'Playfair Display',serif;font-size:1rem;margin-bottom:4px}
.doc-info .spec{color:var(--teal);font-size:0.8rem;font-weight:600}
.doc-info .exp{color:var(--text-muted);font-size:0.78rem;margin-top:6px}



/* ══════════════════════════════════════════
   3D CHATBOT LOGO
══════════════════════════════════════════ */
.bot-fab{position:fixed;bottom:32px;right:32px;z-index:1500;display:flex;flex-direction:column;align-items:center;gap:8px}
.bot-label{background:var(--bg-card);border:1px solid var(--border-t);border-radius:20px;padding:6px 14px;font-size:0.78rem;font-weight:600;color:var(--teal);white-space:nowrap;opacity:0;transform:translateY(6px) scale(.95);transition:var(--transition);pointer-events:none;box-shadow:0 4px 20px rgba(0,0,0,.2)}
.bot-fab:hover .bot-label{opacity:1;transform:translateY(0) scale(1)}
.bot-3d{width:66px;height:66px;position:relative;cursor:pointer}
.bot-3d-face{width:66px;height:66px;border-radius:18px;background:linear-gradient(145deg,#00e5d2,#009e90,#162a52);display:flex;align-items:center;justify-content:center;font-size:1.85rem;box-shadow:0 8px 32px rgba(0,196,179,.45),0 0 0 1px rgba(0,196,179,.25),inset 0 1px 0 rgba(255,255,255,.2),4px 4px 0 rgba(0,100,90,.3);animation:botBob 3.5s ease-in-out infinite;position:relative;overflow:hidden}
.bot-3d-face::before{content:'';position:absolute;top:-60%;left:-60%;width:220%;height:220%;background:conic-gradient(transparent,rgba(255,255,255,.12),transparent 30%);animation:botSheen 3s linear infinite}
@keyframes botBob{0%,100%{transform:translateY(0) rotate(-1deg)}50%{transform:translateY(-9px) rotate(1deg)}}
@keyframes botSheen{to{transform:rotate(360deg)}}
.bot-ring{position:absolute;inset:-7px;border-radius:24px;border:2px solid rgba(0,196,179,.3);animation:botRing 2.2s ease-in-out infinite}
@keyframes botRing{0%,100%{transform:scale(1);opacity:.5}50%{transform:scale(1.1);opacity:1}}
.bot-ring2{position:absolute;inset:-14px;border-radius:30px;border:1px solid rgba(0,196,179,.15);animation:botRing 2.2s ease-in-out infinite .6s}

/* ══════════════════════════════════════════
   FOOTER
══════════════════════════════════════════ */
footer{background:var(--bg-card);border-top:1px solid var(--border);padding:44px 56px;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:24px}
.footer-brand .logo{margin-bottom:8px}
.footer-brand p{color:var(--text-muted);font-size:0.82rem;max-width:300px;line-height:1.6}
.footer-links{display:flex;gap:24px;flex-wrap:wrap}
.footer-links a{color:var(--text-muted);font-size:0.85rem;transition:var(--transition);cursor:pointer}
.footer-links a:hover{color:var(--teal)}
.footer-copy{color:var(--text-sub);font-size:0.78rem;width:100%}

/* ══════════════════════════════════════════
   LOADING SPINNER
══════════════════════════════════════════ */
.spinner{display:inline-block;width:22px;height:22px;border:3px solid rgba(0,196,179,.2);border-top-color:var(--teal);border-radius:50%;animation:spin .7s linear infinite;vertical-align:middle;margin-right:8px}
@keyframes spin{to{transform:rotate(360deg)}}
.loading-row{text-align:center;padding:50px;color:var(--text-muted)}

/* ══════════════════════════════════════════
   RESPONSIVE
══════════════════════════════════════════ */
@media(max-width:900px){
  .hero{grid-template-columns:1fr;min-height:auto}
  .hero-right{height:300px}
  .hero-left{padding:50px 28px 40px}
  .section{padding:60px 24px}
  .split{grid-template-columns:1fr}
  .split img{height:260px}
  .med-search-bar{grid-template-columns:1fr 1fr;grid-template-rows:auto auto}
  .med-search-bar .search-input:first-child{grid-column:1/-1}
  nav{padding:0 20px}
  .nav-links{display:none}
  .form-row{grid-template-columns:1fr}
  footer{padding:36px 24px}
}
@media(max-width:600px){
  .stats-bar{grid-template-columns:1fr 1fr}
  .modal{margin:12px}
  .bot-fab{bottom:20px;right:20px}
  .med-table th:nth-child(5),.med-table td:nth-child(5){display:none}
}
</style>
</head>
<body>

<!-- ═══════════ NAV ═══════════ -->
<nav id="nav">
  <div class="logo">MediCare</div>
  <ul class="nav-links">
    <li><a id="n-home"       onclick="go('home')"       class="active">Home</a></li>
    <li><a id="n-diseases"   onclick="go('diseases')">Diseases</a></li>
    <li><a id="n-medicine"   onclick="go('medicine')">Medicine</a></li>
    <li><a id="n-prevention" onclick="go('prevention')">Prevention</a></li>
    <li><a id="n-cure"       onclick="go('cure')">Cure & Treatment</a></li>

  </ul>
  <div class="nav-right">
    <span class="theme-icon" id="themeIcon" title="Toggle theme" onclick="toggleTheme()">🌙</span>
    <button class="theme-toggle" onclick="toggleTheme()" title="Toggle theme" aria-label="Toggle dark/light mode"></button>
  </div>
</nav>
