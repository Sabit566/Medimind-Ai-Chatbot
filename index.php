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
