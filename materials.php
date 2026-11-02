<?php header("Content-Type: text/html; charset=UTF-8"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<title>Materials — BoutiqBiz</title>
<style>
/* ── INLINE SVG ICONS ── */
.ico{display:inline-flex;align-items:center;justify-content:center;flex-shrink:0;vertical-align:middle;}
.ico svg{display:block;}
</style>
<script>
function ico(name,size,color){
  size=size||16;color=color||'currentColor';
  var paths={
    'arrow-left':'M19 12H5M12 5l-7 7 7 7',
    'search':'M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z',
    'adjustments':'M4 6h16M8 12h8M11 18h2',
    'plus':'M12 5v14M5 12h14',
    'settings':'M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6.93-3c0-.46-.04-.92-.12-1.36l2.94-2.3-3-5.2-3.46 1.32a7.8 7.8 0 0 0-2.36-1.36L12.5 2h-1l-.43 2.1a7.8 7.8 0 0 0-2.36 1.36L5.25 4.14l-3 5.2 2.94 2.3A7.7 7.7 0 0 0 5.07 13l-2.94 2.3 3 5.2 3.46-1.32c.74.52 1.54.95 2.36 1.36L11.5 23h1l.43-2.1a7.8 7.8 0 0 0 2.36-1.36l3.46 1.32 3-5.2L18.93 13c.08-.44.12-.9.12-1z',
    'shopify':'M15.5 4.5c-.1-.6-.6-1-1.2-1.1l-1.2-.1-.5-1.5C12.4 1.3 12 1 11.5 1s-.9.3-1.1.8l-.5 1.5-1.2.1c-.6.1-1.1.5-1.2 1.1L6 17.5l6 1.5 6-1.5-2.5-13z',
    'refresh':'M4 4v5h5M20 20v-5h-5M20.49 9A9 9 0 0 0 5.64 5.64L4 4M3.51 15a9 9 0 0 0 14.85 3.36L20 20',
    'sparkles':'M12 3l1.5 4.5H18l-3.75 2.75L15.75 15 12 12.25 8.25 15l1.5-4.75L6 7.5h4.5L12 3zM5 19l1 2 1-2 2-1-2-1-1-2-1 2-2 1 2 1zM19 5l.5 1.5 1.5.5-1.5.5L19 9l-.5-1.5L17 7l1.5-.5L19 5z',
    'shirt':'M20.38 3.46L16 2a4 4 0 0 1-8 0L3.62 3.46a2 2 0 0 0-1.34 2.23l.58 3.57a1 1 0 0 0 .99.84H6v10a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V10h2.15a1 1 0 0 0 .99-.84l.58-3.57a2 2 0 0 0-1.34-2.23z',
    'chevron-right':'M9 18l6-6-6-6',
    'chevron-down':'M6 9l6 6 6-6',
    'x':'M18 6L6 18M6 6l12 12',
    'trash':'M3 6h18M8 6V4h8v2M19 6l-1 14H6L5 6',
    'copy':'M8 4H6a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-4-4H8zm0 0v4h8M8 12h8M8 16h4',
    'photo':'M21 15l-5-5L5 21M3 3h18v18H3zM9 9a2 2 0 1 1-4 0 2 2 0 0 1 4 0',
    'photo-up':'M21 15l-5-5L9 17M3 3h18v18H3zM12 7v6m-3-3l3-3 3 3',
    'link':'M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71',
    'file-text':'M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8zM14 2v6h6M16 13H8M16 17H8M10 9H8',
    'file-off':'M4 4l16 16M14 2H6a2 2 0 0 0-2 2v16M10 2l4 6h6M8 21h10a2 2 0 0 0 2-2V8',
    'barcode':'M4 7v10M8 7v10M12 7v10M16 7v10M20 7v10M6 7v10M10 7v10M14 7v10M18 7v10',
    'box':'M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16zM3.27 6.96L12 12.01l8.73-5.05M12 22.08V12',
    'tag':'M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82zM7 7h.01',
    'alert-triangle':'M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0zM12 9v4M12 17h.01',
    'arrow-right':'M5 12h14M12 5l7 7-7 7',
    'arrow-up':'M12 19V5M5 12l7-7 7 7',
    'arrow-down':'M12 5v14M19 12l-7 7-7-7',
    'building-store':'M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2zM9 22V12h6v10',
    'truck':'M1 3h15v13H1zM16 8h4l3 3v5h-7V8zM5.5 21a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5zM18.5 21a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z',
    'hammer':'M15 12l-8.5 8.5a2.12 2.12 0 0 1-3-3L12 9M17.64 15L22 10.36M20.35 6.22l-2.57-2.57a1 1 0 0 0-1.41 0L14.5 5.5l3.54 3.54 2.31-2.32a1 1 0 0 0 0-1.5z',
    'download':'M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M7 10l5 5 5-5M12 15V3',
    'upload':'M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M17 8l-5-5-5 5M12 3v12',
    'grip-vertical':'M9 5a1 1 0 1 0 0-2 1 1 0 0 0 0 2zM9 13a1 1 0 1 0 0-2 1 1 0 0 0 0 2zM9 21a1 1 0 1 0 0-2 1 1 0 0 0 0 2zM15 5a1 1 0 1 0 0-2 1 1 0 0 0 0 2zM15 13a1 1 0 1 0 0-2 1 1 0 0 0 0 2zM15 21a1 1 0 1 0 0-2 1 1 0 0 0 0 2z',
    'ruler-2':'M3 5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5zM8 5v3M12 5v5M16 5v3',
    'palette':'M12 2a10 10 0 0 0 0 20c.6 0 1-.4 1-1v-1c0-.5.5-1 1-1h3c2.8 0 5-2.2 5-5 0-5.5-4.5-12-10-12z',
    'texture':'M3 3h4v4H3zM3 10h4v4H3zM3 17h4v4H3zM10 3h4v4h-4zM10 10h4v4h-4zM10 17h4v4h-4zM17 3h4v4h-4zM17 10h4v4h-4zM17 17h4v4h-4z',
    'calculator':'M4 4h16v16H4zM8 8h1v1H8zM11 8h1v1h-1zM14 8h1v1h-1zM8 11h1v1H8zM11 11h1v1h-1zM14 11h1v1h-1zM8 14h1v4H8zM11 14h1v1h-1zM14 14h1v1h-1zM11 17h4v1h-4z',
    'building-factory-2':'M3 21V9l9-6 9 6v12M9 21v-6h6v6M3 12h18',
    'edit':'M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7M18.5 2.5a2.12 2.12 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z',
    'bookmark':'M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z',
    'check':'M20 6L9 17l-5-5',
    'store':'M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2zM9 22V12h6v10',
    'filter':'M22 3H2l8 9.46V19l4 2v-8.54L22 3z',
    'factory':'M3 21V9l9-6 9 6v12M9 21v-6h6v6M3 12h18',
    'ruler':'M3 5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5zM8 5v3M12 5v5M16 5v3',
  };
  var d=paths[name]||'M12 12h.01';
  var segs=d.split(/(?=M)/);
  return '<svg width="'+size+'" height="'+size+'" viewBox="0 0 24 24" fill="none" stroke="'+color+'" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">'+segs.map(function(s){return '<path d="'+s.trim()+'"/>';}).join('')+'</svg>';
}
</script>
<style>
:root{
  --p:#4A3BB5;--pl:#EEEDFE;--pm:#AFA9EC;--pt:#3C3489;
  --g:#1D9E75;--gl:#EAF3DE;--gt:#3B6D11;
  --r:#E24B4A;--rl:#FCEBEB;--rt:#A32D2D;
  --a:#BA7517;--al:#FAEEDA;--at:#854F0B;
  --b:#185FA5;--bl:#E6F1FB;--bt:#0C447C;
  --bg:#F4F3FB;--sf:#fff;--sf2:#F7F6FD;
  --br:rgba(74,59,181,0.11);--br2:rgba(74,59,181,0.2);
  --tx:#1A1740;--tx2:#6B6494;--tx3:#A09CC0;
  --rad:12px;--rads:8px;
  --st:env(safe-area-inset-top,0px);--sb:env(safe-area-inset-bottom,0px);
}
*{box-sizing:border-box;margin:0;padding:0;-webkit-tap-highlight-color:transparent;}
body{font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;background:var(--bg);color:var(--tx);min-height:100dvh;font-size:14px;line-height:1.5;}

/* ─ SCREEN ROUTER ─ */
.screen{display:none;}
.screen.on{display:flex;flex-direction:column;min-height:100dvh;}

/* ─ TOPBAR ─ */
.tb{background:var(--p);padding:calc(max(var(--st),12px)+8px) 16px 14px;display:flex;align-items:center;gap:10px;flex-shrink:0;}
.tb-bk{width:34px;height:34px;border-radius:50%;background:rgba(255,255,255,0.16);border:none;display:flex;align-items:center;justify-content:center;cursor:pointer;color:#fff;flex-shrink:0;}
.tb-info{flex:1;min-width:0;}
.tb-title{color:#fff;font-size:16px;font-weight:600;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;letter-spacing:-0.2px;}
.tb-sub{color:rgba(255,255,255,0.65);font-size:12px;margin-top:3px;}
.tb-acts{display:flex;gap:7px;flex-shrink:0;align-items:center;}
.tbb{background:rgba(255,255,255,0.18);color:#fff;border:none;border-radius:var(--rads);padding:8px 13px;font-size:12px;font-weight:500;cursor:pointer;white-space:nowrap;display:inline-flex;align-items:center;gap:5px;}
.tbb.white{background:#fff;color:var(--p);}
.tbb.ghost{background:rgba(255,255,255,0.16);color:#fff;}
.tbb.green{background:#96BF48;color:#fff;}

/* ─ TABBAR ─ */
.tab-strip{background:var(--p);padding:0 16px 14px;flex-shrink:0;}
.tab-inner{display:flex;background:rgba(255,255,255,0.14);border-radius:8px;padding:3px;}
.tab{flex:1;text-align:center;padding:6px 4px;border-radius:6px;font-size:11px;color:rgba(255,255,255,0.65);cursor:pointer;font-weight:500;transition:all 0.15s;white-space:nowrap;}
.tab.on{background:#fff;color:var(--p);}

/* ─ SCROLL BODY ─ */
.scroll-body{flex:1;overflow-y:auto;padding-bottom:calc(var(--sb)+24px);}

/* ─ SECTION ─ */
.sec{background:var(--sf);border-radius:var(--rad);margin:10px 12px 0;border:0.5px solid var(--br);overflow:hidden;}
.sec-hdr{display:flex;align-items:center;justify-content:space-between;padding:12px 14px;border-bottom:0.5px solid var(--br);}
.sec-title{font-size:13px;font-weight:500;color:var(--tx);}
.sec-act{font-size:12px;color:var(--p);cursor:pointer;font-weight:500;}

/* ─ FIELDS ─ */
.f{padding:11px 14px 0;}
.f.last{padding-bottom:12px;}
.f2{display:grid;grid-template-columns:1fr 1fr;gap:10px;padding:11px 14px 0;}
.f2.last{padding-bottom:12px;}
.lbl{font-size:11px;font-weight:500;color:var(--tx2);margin-bottom:4px;letter-spacing:0.2px;}
.inp{width:100%;border:0.5px solid var(--br2);border-radius:var(--rads);padding:9px 11px;font-size:13px;color:var(--tx);background:var(--sf2);outline:none;font-family:inherit;-webkit-appearance:none;appearance:none;transition:border-color 0.15s,box-shadow 0.15s;}
.inp:focus{border-color:var(--p);box-shadow:0 0 0 3px rgba(74,59,181,0.1);background:#fff;}
.inp::placeholder{color:var(--tx3);}
textarea.inp{resize:none;line-height:1.5;}
select.inp{cursor:pointer;background-image:url("data:image/svg+xml,%3Csvg width='12' height='8' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1 1l5 6 5-6' stroke='%236B6494' stroke-width='1.5' stroke-linecap='round'/%3E%3C/svg%3E");background-repeat:no-repeat;background-position:right 10px center;padding-right:28px;}
.row-f{display:flex;align-items:center;padding:10px 14px;border-bottom:0.5px solid var(--br);}
.row-f:last-child{border-bottom:none;}
.rf-lbl{font-size:12px;color:var(--tx2);width:90px;flex-shrink:0;}
.rf-inp{flex:1;border:none;background:transparent;font-size:13px;color:var(--tx);outline:none;font-family:inherit;min-width:0;}
.rf-inp::placeholder{color:var(--tx3);}
.hdiv{height:0.5px;background:var(--br);margin:0 14px;}

/* ─ AI BOX ─ */
.desc-box{margin:0 14px 12px;border:0.5px solid var(--br2);border-radius:var(--rads);overflow:hidden;}
.desc-ta{width:100%;border:none;padding:9px 11px 7px;font-size:13px;color:var(--tx);background:var(--sf2);outline:none;resize:none;line-height:1.5;font-family:inherit;}
.desc-bar{display:flex;align-items:center;justify-content:space-between;padding:6px 10px;background:var(--sf2);border-top:0.5px solid var(--br);}
.desc-chars{font-size:11px;color:var(--tx3);}
.ai-btn{display:flex;align-items:center;gap:4px;padding:5px 9px;border-radius:6px;background:var(--pl);border:0.5px solid var(--pm);color:var(--pt);font-size:11px;font-weight:500;cursor:pointer;}
.cred{display:flex;align-items:center;gap:4px;padding:3px 8px;border-radius:20px;background:var(--pl);color:var(--pt);font-size:11px;font-weight:500;}
.cred-dot{width:5px;height:5px;border-radius:50%;background:var(--p);}
.ai-gen{margin:0 14px 12px;border:0.5px solid var(--pm);border-radius:var(--rads);background:var(--pl);overflow:hidden;}
.ai-gen-top{display:flex;align-items:center;gap:6px;padding:9px 12px;border-bottom:0.5px solid rgba(175,169,236,0.4);}
.ai-gen-text{padding:9px 12px;font-size:12px;color:#534AB7;line-height:1.6;}
.ai-gen-acts{display:flex;gap:7px;padding:0 12px 11px;}
.ai-use{flex:1;padding:7px;border-radius:6px;background:var(--p);color:#fff;border:none;font-size:12px;font-weight:500;cursor:pointer;}
.ai-retry{padding:7px 11px;border-radius:6px;background:transparent;color:#534AB7;border:0.5px solid var(--pm);font-size:12px;cursor:pointer;}

/* ─ IMAGES ─ */
.img-zone{margin:0 14px 12px;border:0.5px dashed var(--br2);border-radius:var(--rads);padding:18px;text-align:center;cursor:pointer;background:var(--sf2);transition:border-color 0.15s,background 0.15s;}
.img-zone:hover{border-color:var(--p);background:var(--pl);}
.img-zone i{font-size:22px;color:#534AB7;display:block;margin:0 auto 6px;}
.img-zone-lbl{font-size:13px;font-weight:500;color:var(--tx);}
.img-zone-sub{font-size:11px;color:var(--tx3);margin-top:2px;}
.img-previews{display:flex;gap:8px;padding:0 14px 12px;flex-wrap:wrap;}
.img-thumb{width:64px;height:64px;border-radius:8px;border:0.5px solid var(--br);overflow:hidden;position:relative;}
.img-thumb img{width:100%;height:100%;object-fit:cover;}
.img-thumb.featured::after{content:'Main';position:absolute;bottom:0;left:0;right:0;background:var(--p);color:#fff;font-size:9px;text-align:center;padding:2px 0;}
.img-del{position:absolute;top:3px;right:3px;width:16px;height:16px;border-radius:50%;background:rgba(0,0,0,0.5);border:none;color:#fff;font-size:11px;display:flex;align-items:center;justify-content:center;cursor:pointer;}
input[type=file]{display:none;}

/* ─ CUSTOM TABS ─ */
.ctab-pill{padding:10px 14px;font-size:13px;font-weight:500;color:var(--tx2);cursor:pointer;border-bottom:2px solid transparent;white-space:nowrap;transition:color 0.15s,border-color 0.15s;flex-shrink:0;}
.ctab-pill:hover{color:var(--tx);}
.ctab-active{color:var(--p)!important;border-bottom-color:var(--p)!important;}
.ctab-add{display:flex;align-items:center;gap:5px;padding:8px 10px;font-size:12px;color:var(--tx3);background:none;border:none;cursor:pointer;font-family:inherit;white-space:nowrap;margin-left:auto;flex-shrink:0;}
.ctab-add:hover{color:var(--p);}
#ctabs-row::-webkit-scrollbar{display:none;}
#ctab-dynamic{display:contents;}

/* ─ LIST ─ */
.list-ctrl{background:var(--sf);border-bottom:0.5px solid var(--br);padding:9px 12px;display:flex;align-items:center;gap:7px;flex-shrink:0;}
.srch{flex:1;display:flex;align-items:center;gap:7px;background:var(--sf2);border:0.5px solid var(--br2);border-radius:var(--rads);padding:7px 10px;}
.srch i{font-size:15px;color:var(--tx3);}
.srch input{border:none;background:transparent;font-size:13px;color:var(--tx);outline:none;width:100%;font-family:inherit;}
.srch input::placeholder{color:var(--tx3);}
.filt-btn{display:flex;align-items:center;gap:4px;padding:7px 10px;border:0.5px solid var(--br2);border-radius:var(--rads);font-size:12px;color:var(--tx2);background:var(--sf2);cursor:pointer;white-space:nowrap;font-weight:500;}
.filt-btn.act{background:var(--pl);border-color:var(--pm);color:var(--pt);}
.af-bar{display:flex;gap:6px;padding:7px 12px;background:var(--sf);border-bottom:0.5px solid var(--br);overflow-x:auto;flex-shrink:0;}
.af-bar::-webkit-scrollbar{display:none;}
/* ─ NAV DRAWER ─ */
.nav-drawer{background:var(--sf);width:78vw;max-width:300px;min-height:100dvh;display:flex;flex-direction:column;box-shadow:4px 0 24px rgba(0,0,0,0.12);}
.nav-drawer-hdr{display:flex;align-items:center;justify-content:space-between;padding:calc(var(--st)+18px) 16px 14px;border-bottom:0.5px solid var(--br);}
.nav-item{display:flex;align-items:center;gap:12px;padding:12px 18px;font-size:14px;color:var(--tx2);cursor:pointer;border-radius:0;transition:background 0.12s;}
.nav-item:hover{background:var(--sf2);}
.nav-item.on{color:var(--p);background:var(--pl);font-weight:500;}
.nav-item.on svg{stroke:var(--p);}
/* ─ REPORT CARDS ─ */
.rpt-card{display:flex;align-items:center;gap:12px;padding:13px 14px;background:var(--sf);margin:0 12px 7px;border-radius:var(--rad);border:0.5px solid var(--br);cursor:pointer;}
.rpt-card:hover{border-color:var(--pm);background:var(--pl);}
.rpt-icon{width:38px;height:38px;border-radius:9px;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
.rpt-info{flex:1;min-width:0;}
.rpt-title{font-size:13px;font-weight:500;color:var(--tx);}
.rpt-sub{font-size:11px;color:var(--tx2);margin-top:2px;}
.fp-group{border-bottom:0.5px solid var(--br);}
.fp-hdr{display:flex;align-items:center;padding:11px 14px;cursor:pointer;gap:8px;user-select:none;}
.fp-hdr:hover{background:var(--sf2);}
.fp-lbl{font-size:13px;font-weight:500;color:var(--tx);flex:1;}
.fp-val{font-size:12px;color:var(--p);font-weight:500;flex-shrink:0;}
.fp-val.muted{color:var(--tx3);font-weight:400;}
.fp-arr{flex-shrink:0;color:var(--tx3);transition:transform 0.2s;}
.fp-arr.open{transform:rotate(180deg);}
.fp-body{background:var(--sf2);border-top:0.5px solid var(--br);}
.fp-check{display:flex;align-items:center;gap:10px;padding:10px 14px;font-size:13px;color:var(--tx);cursor:pointer;border-bottom:0.5px solid var(--br);}
.fp-check:last-child{border-bottom:none;}
.fp-check:hover{background:var(--pl);}
.fp-check input[type=checkbox]{width:16px;height:16px;border-radius:4px;accent-color:var(--p);cursor:pointer;flex-shrink:0;}
.fp-radio{display:flex;align-items:center;gap:10px;padding:10px 14px;font-size:13px;color:var(--tx);cursor:pointer;border-bottom:0.5px solid var(--br);}
.fp-radio:last-child{border-bottom:none;}
.fp-radio:hover{background:var(--pl);}
.fp-radio input[type=radio]{width:16px;height:16px;accent-color:var(--p);cursor:pointer;flex-shrink:0;}
.afc{display:inline-flex;align-items:center;gap:4px;padding:4px 10px;border-radius:20px;font-size:11px;font-weight:500;cursor:pointer;white-space:nowrap;}
.afc.purple{background:var(--pl);color:var(--pt);}
.afc.red{background:var(--rl);color:var(--rt);}
.afc.green{background:var(--gl);color:var(--gt);}
.afc.amber{background:var(--al);color:var(--at);}
.list-meta{padding:7px 14px 3px;font-size:11px;color:var(--tx2);flex-shrink:0;}
.mat-card{background:var(--sf);margin:6px 12px 0;border-radius:var(--rad);border:0.5px solid var(--br);overflow:hidden;}
.mrow{display:flex;align-items:center;gap:9px;padding:11px 12px;cursor:pointer;}
.mth{width:42px;height:42px;border-radius:8px;overflow:hidden;flex-shrink:0;background:var(--sf2);border:0.5px solid var(--br);display:flex;align-items:center;justify-content:center;}
.mth img{width:100%;height:100%;object-fit:cover;}
.mth i{font-size:20px;color:var(--tx3);}
.mi{flex:1;min-width:0;}
.mnrow{display:flex;align-items:center;gap:5px;}
.mname{font-size:13px;font-weight:500;color:var(--tx);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
.mbadge{font-size:10px;padding:2px 6px;border-radius:4px;font-weight:500;flex-shrink:0;}
.mbadge.finished{background:var(--pl);color:var(--pt);}
.mbadge.raw{background:var(--gl);color:var(--gt);}
.mbadge.production{background:var(--al);color:var(--at);}
.msub{font-size:11px;color:var(--tx2);margin-top:2px;}
.msku{font-size:10px;color:var(--tx3);margin-top:1px;font-family:monospace,monospace;}
.mqw{text-align:right;flex-shrink:0;}
.mqty{font-size:15px;font-weight:500;}
.mqty.ok{color:var(--g);}
.mqty.lo{color:var(--r);}
.mqty-l{font-size:10px;color:var(--tx3);}
.mexp{width:32px;height:32px;display:flex;align-items:center;justify-content:center;flex-shrink:0;border-radius:8px;cursor:pointer;transition:background 0.12s;}
.mexp:hover{background:var(--sf2);}
.mexp svg{transition:transform 0.2s;color:var(--tx3);}
.mexp.open svg{transform:rotate(90deg);}
/* variant expand hint pill */
.vcount-pill{font-size:9px;font-weight:600;color:var(--tx3);background:var(--sf2);border:0.5px solid var(--br2);border-radius:10px;padding:1px 5px;margin-left:3px;}
.vlist{border-top:0.5px solid var(--br);}
.vrow{display:flex;align-items:center;padding:0 12px;border-bottom:0.5px solid var(--br);cursor:pointer;}
.vrow:last-child{border-bottom:none;}
.vi-in{width:20px;flex-shrink:0;display:flex;align-items:center;justify-content:center;align-self:stretch;}
.vi-ln{width:1px;height:100%;background:var(--br2);}
.vi-cn{width:8px;height:1px;background:var(--br2);margin-top:20px;flex-shrink:0;}
.vi-inner{display:flex;align-items:center;gap:7px;flex:1;padding:8px 0 8px 5px;}
.vidw{width:24px;height:24px;border-radius:5px;border:0.5px solid var(--br);background:var(--sf2);display:flex;align-items:center;justify-content:center;flex-shrink:0;}
.vdot{width:9px;height:9px;border-radius:50%;}
.viinf{flex:1;min-width:0;}
.viname{font-size:12px;color:var(--tx);}
.visku{font-size:10px;color:var(--tx3);font-family:monospace,monospace;}
.viqty{font-size:12px;font-weight:500;}
.viqty.ok{color:var(--g);}
.viqty.lo{color:var(--r);}
.viarr{font-size:11px;color:var(--tx3);margin-left:3px;}

/* ─ OPTION CATEGORIES ─ */
.opt-card{border-bottom:0.5px solid var(--br);}
.opt-card:last-child{border-bottom:none;}
.opt-cat-row{display:flex;align-items:center;gap:9px;padding:11px 14px;background:var(--sf);}
.opt-cat-name{flex:1;font-size:13px;font-weight:500;color:var(--tx);}
.opt-cat-count{font-size:11px;color:var(--tx3);}
.opt-cat-del{color:var(--tx3);cursor:pointer;font-size:16px;}
.opt-cat-del:hover{color:var(--r);}
.opt-values{background:var(--sf2);padding:9px 14px 11px;border-top:0.5px solid var(--br);}
.val-chips{display:flex;flex-wrap:wrap;gap:6px;margin-bottom:9px;}
.val-chip{display:inline-flex;align-items:center;gap:4px;padding:4px 9px;border-radius:20px;font-size:12px;font-weight:500;border:0.5px solid var(--br2);background:var(--sf);color:var(--tx);}
.val-chip.size-s{background:#E6F1FB;border-color:#B5D4F4;color:#0C447C;}
.val-chip.color-s{background:#FAEEDA;border-color:#FAC775;color:#633806;}
.val-chip.material-s{background:#EAF3DE;border-color:#C0DD97;color:#3B6D11;}
.val-chip.custom-s{background:#EEEDFE;border-color:#AFA9EC;color:#3C3489;}
.val-del{cursor:pointer;color:var(--tx3);font-size:13px;}
.val-del:hover{color:var(--r);}
.add-val-row{display:flex;gap:7px;}
.add-val-inp{flex:1;border:0.5px solid var(--br2);border-radius:var(--rads);padding:7px 10px;font-size:13px;color:var(--tx);background:var(--sf);outline:none;font-family:inherit;}
.add-val-inp:focus{border-color:var(--p);}
.add-val-btn{padding:7px 11px;border-radius:var(--rads);background:var(--p);color:#fff;border:none;font-size:12px;font-weight:500;cursor:pointer;}
.cat-sugs{display:flex;gap:6px;padding:9px 14px 4px;flex-wrap:wrap;}
.cat-sug{padding:5px 11px;border-radius:20px;font-size:12px;border:0.5px solid var(--br2);color:var(--tx2);background:var(--sf2);cursor:pointer;}
.cat-sug:hover{background:var(--pl);border-color:var(--pm);color:var(--pt);}
.add-cat-row{display:flex;gap:7px;padding:11px 14px;border-top:0.5px solid var(--br);}
.add-cat-inp{flex:1;border:0.5px solid var(--br2);border-radius:var(--rads);padding:9px 11px;font-size:13px;color:var(--tx);background:var(--sf2);outline:none;font-family:inherit;}
.add-cat-inp:focus{border-color:var(--p);}
.add-cat-btn{padding:9px 13px;border-radius:var(--rads);background:var(--p);color:#fff;border:none;font-size:12px;font-weight:500;cursor:pointer;}

/* ─ VARIANT MATRIX ─ */
.vm-item{background:var(--sf);border-radius:10px;margin:0 12px 7px;border:0.5px solid var(--br);overflow:hidden;}
.vm-top{display:flex;align-items:flex-start;gap:8px;padding:9px 12px;}
.vm-img{width:40px;height:40px;border-radius:7px;flex-shrink:0;position:relative;cursor:pointer;}
.vm-img-e{width:100%;height:100%;border-radius:7px;border:0.5px dashed var(--br2);background:var(--sf2);display:flex;align-items:center;justify-content:center;}
.vm-img-e i{font-size:14px;color:var(--tx3);}
.vm-img-f{width:100%;height:100%;border-radius:7px;overflow:hidden;border:0.5px solid var(--br);}
.vm-img-f img{width:100%;height:100%;object-fit:cover;}
.vm-img-plus{position:absolute;bottom:-3px;right:-3px;width:15px;height:15px;border-radius:50%;background:var(--p);display:flex;align-items:center;justify-content:center;border:1.5px solid #fff;}
.vm-img-plus i{font-size:9px;color:#fff;}
.vm-main{flex:1;min-width:0;}
.vm-tags{display:flex;flex-wrap:wrap;gap:4px;margin-bottom:5px;}
.vm-tag{padding:3px 7px;border-radius:20px;font-size:11px;font-weight:500;}
.vm-tag.size-s{background:#E6F1FB;color:#0C447C;}
.vm-tag.color-s{background:#FAEEDA;color:#633806;}
.vm-tag.material-s{background:#EAF3DE;color:#3B6D11;}
.vm-tag.custom-s{background:#EEEDFE;color:#3C3489;}
.vm-sku-inp{width:100%;border:none;background:transparent;font-size:11px;color:var(--tx3);outline:none;font-family:monospace,monospace;padding:0;}
.vm-sku-inp::placeholder{color:var(--tx3);}
.vm-right{display:flex;flex-direction:column;align-items:flex-end;gap:5px;flex-shrink:0;}
.stp{display:flex;align-items:center;border:0.5px solid var(--br2);border-radius:6px;overflow:hidden;}
.stb{width:26px;height:26px;display:flex;align-items:center;justify-content:center;background:var(--sf2);border:none;cursor:pointer;color:var(--tx);font-size:16px;line-height:1;}
.stv{width:30px;text-align:center;font-size:12px;font-weight:500;color:var(--tx);border:none;background:transparent;outline:none;font-family:inherit;}
.vm-detail-link{font-size:11px;color:var(--p);cursor:pointer;font-weight:500;display:flex;align-items:center;gap:2px;}

/* variant footer: price grid */
.vm-price-grid{display:grid;grid-template-columns:1fr 1fr 1fr;border-top:0.5px solid var(--br);}
.vpc{padding:7px 10px;border-right:0.5px solid var(--br);}
.vpc:last-child{border-right:none;}
.vpc-lbl{font-size:10px;color:var(--tx3);margin-bottom:2px;}
.vpc-row{display:flex;align-items:center;gap:2px;}
.vpc-pre{font-size:10px;color:var(--tx3);}
.vpc-inp{border:none;background:transparent;font-size:12px;font-weight:500;color:var(--tx);width:100%;outline:none;font-family:inherit;min-width:0;}
.vpc-inp.offer{color:var(--g);}
.bc-row{display:flex;align-items:center;gap:6px;padding:7px 12px;border-top:0.5px solid var(--br);}
.bc-row i{font-size:14px;color:var(--tx3);}
.bc-inp{flex:1;border:none;background:transparent;font-size:11px;color:var(--tx2);outline:none;font-family:monospace,monospace;}
.bc-inp::placeholder{color:var(--tx3);}
.bc-gen-btn{font-size:11px;color:var(--p);cursor:pointer;font-weight:500;white-space:nowrap;}

.gen-btn{display:flex;align-items:center;justify-content:center;gap:6px;width:calc(100% - 24px);margin:10px 12px 0;padding:11px;border-radius:10px;background:var(--pl);color:#534AB7;border:0.5px solid var(--pm);font-size:13px;font-weight:500;cursor:pointer;}
.gen-btn:hover{background:var(--p);color:#fff;}
.gen-badge{display:inline-flex;align-items:center;justify-content:center;min-width:18px;height:18px;border-radius:9px;background:var(--p);color:#fff;font-size:10px;font-weight:500;padding:0 5px;}
.apply-banner{background:var(--pl);border-radius:10px;margin:10px 12px 0;padding:10px 13px;display:flex;align-items:center;gap:9px;border:0.5px solid var(--pm);}
.apply-icon{width:30px;height:30px;border-radius:7px;background:var(--p);display:flex;align-items:center;justify-content:center;flex-shrink:0;}
.apply-icon i{font-size:16px;color:#fff;}
.apply-text{flex:1;}
.apply-title{font-size:12px;font-weight:500;color:var(--pt);}
.apply-sub{font-size:11px;color:#534AB7;margin-top:1px;}
.apply-btn{background:var(--p);color:#fff;border:none;border-radius:6px;padding:5px 10px;font-size:11px;font-weight:500;cursor:pointer;}

/* ─ VARIANT DETAIL ─ */
.price-grid{display:grid;grid-template-columns:1fr 1fr;gap:0;}
.pc{padding:10px 14px;border-right:0.5px solid var(--br);border-bottom:0.5px solid var(--br);}
.pc:nth-child(even){border-right:none;}
.pc:nth-last-child(-n+2){border-bottom:none;}
.pc-lbl{font-size:10px;color:var(--tx3);margin-bottom:3px;text-transform:uppercase;letter-spacing:0.2px;}
.pc-row{display:flex;align-items:center;gap:3px;}
.pc-pre{font-size:11px;color:var(--tx3);}
.pc-inp{border:none;background:transparent;font-size:14px;font-weight:500;color:var(--tx);outline:none;font-family:inherit;width:100%;min-width:0;}
.pc-inp.offer{color:var(--g);}
.disc-pill{display:inline-flex;align-items:center;gap:3px;font-size:10px;padding:2px 7px;border-radius:20px;background:var(--gl);color:var(--gt);font-weight:500;margin-top:3px;}

/* barcode inline */
.bc-preview{background:var(--sf2);border-radius:8px;margin:10px 14px;padding:11px;text-align:center;border:0.5px solid var(--br);}
.bc-preview canvas{display:block;margin:0 auto;}
.bc-preview p{font-size:10px;color:var(--tx3);margin-top:5px;font-family:monospace,monospace;}
.bc-acts{display:flex;gap:6px;margin-top:8px;justify-content:center;}
.bc-acts button{padding:5px 12px;border-radius:6px;font-size:11px;font-weight:500;cursor:pointer;border:none;}
.bc-dl{background:var(--p);color:#fff;}
.bc-cp{background:var(--pl);color:var(--pt);}

/* ─ INVENTORY ─ */
.inv-sum{display:grid;grid-template-columns:1fr 1fr;gap:7px;padding:10px 12px 4px;}
.inv-sc{background:var(--sf);border-radius:9px;border:0.5px solid var(--br);padding:9px 11px;}
.inv-sc-l{font-size:10px;color:var(--tx3);}
.inv-sc-v{font-size:16px;font-weight:500;margin-top:2px;}
.inv-sc-v.ok{color:var(--g);}
.inv-sc-v.lo{color:var(--r);}
.inv-loc{background:var(--sf);border-radius:10px;margin:7px 12px 0;border:0.5px solid var(--br);overflow:hidden;}
.inv-loc-hdr{display:flex;align-items:center;gap:8px;padding:10px 13px;border-bottom:0.5px solid var(--br);}
.inv-loc-ico{width:28px;height:28px;border-radius:6px;display:flex;align-items:center;justify-content:center;font-size:15px;flex-shrink:0;}
.inv-loc-name{flex:1;font-size:13px;font-weight:500;color:var(--tx);}
.inv-loc-total{font-size:13px;font-weight:500;}
.inv-loc-total.ok{color:var(--g);}
.inv-loc-total.lo{color:var(--r);}
.inv-vrow{display:flex;align-items:center;padding:8px 13px;border-bottom:0.5px solid var(--br);}
.inv-vrow:last-child{border-bottom:none;}
.inv-vdot{width:7px;height:7px;border-radius:50%;margin-right:7px;flex-shrink:0;}
.inv-vname{flex:1;font-size:12px;color:var(--tx);}
.inv-stp{display:flex;align-items:center;border:0.5px solid var(--br2);border-radius:6px;overflow:hidden;margin-left:8px;}
.inv-stb{width:24px;height:24px;display:flex;align-items:center;justify-content:center;background:var(--sf2);border:none;cursor:pointer;font-size:15px;color:var(--tx);}
.inv-stv{width:26px;text-align:center;font-size:12px;font-weight:500;color:var(--tx);border:none;background:transparent;outline:none;font-family:inherit;}

/* ─ TECHPACK ─ */
.tp-item{display:flex;align-items:center;gap:9px;padding:11px 14px;border-bottom:0.5px solid var(--br);cursor:pointer;}
.tp-item:last-child{border-bottom:none;}
.tp-item:hover{background:var(--sf2);}
.tp-ico{width:32px;height:32px;border-radius:7px;display:flex;align-items:center;justify-content:center;font-size:16px;flex-shrink:0;}
.tp-info{flex:1;min-width:0;}
.tp-name{font-size:13px;font-weight:500;color:var(--tx);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
.tp-meta{font-size:11px;color:var(--tx2);margin-top:1px;}
.tp-linked{display:flex;align-items:center;gap:8px;padding:10px 14px;background:var(--gl);border-bottom:0.5px solid var(--br);}
.tp-linked-badge{font-size:11px;padding:3px 8px;border-radius:20px;background:var(--gl);color:var(--gt);font-weight:500;border:0.5px solid #C0DD97;}

/* ─ COSTING ─ */
.cost-row{display:flex;align-items:center;justify-content:space-between;padding:9px 14px;border-bottom:0.5px solid var(--br);}
.cost-row:last-child{border-bottom:none;}
.cost-lbl{font-size:12px;color:var(--tx2);}
.cost-inp-w{display:flex;align-items:center;gap:3px;}
.cost-pre{font-size:11px;color:var(--tx3);}
.cost-inp{border:none;background:transparent;font-size:13px;font-weight:500;color:var(--tx);width:70px;outline:none;text-align:right;font-family:inherit;}
.cost-total-row{display:flex;align-items:center;justify-content:space-between;padding:10px 14px;background:var(--sf2);}
.cost-total-lbl{font-size:13px;font-weight:500;color:var(--tx);}
.cost-total-v{font-size:15px;font-weight:500;color:var(--p);}
.margin-bar-wrap{margin:0 14px 4px;height:5px;border-radius:3px;background:var(--sf2);overflow:hidden;border:0.5px solid var(--br);}
.margin-fill{height:100%;border-radius:3px;background:var(--g);}
.margin-info{display:flex;justify-content:space-between;padding:0 14px 10px;font-size:11px;color:var(--tx2);}

/* ─ FILTER SHEET ─ */
.sh-ov{display:none;min-height:500px;flex-direction:column;justify-content:flex-end;background:rgba(10,8,40,0.42);}
.sh-ov.open{display:flex;}
.sh{background:var(--sf);border-radius:16px 16px 0 0;padding-bottom:calc(var(--sb)+14px);max-height:88vh;overflow-y:auto;}
.sh-hdl{width:34px;height:4px;background:var(--br2);border-radius:2px;margin:11px auto 0;}
.sh-top{display:flex;align-items:center;justify-content:space-between;padding:12px 16px;border-bottom:0.5px solid var(--br);position:sticky;top:0;background:var(--sf);z-index:5;}
.sh-main-title{font-size:14px;font-weight:500;color:var(--tx);}
.sh-clear{font-size:12px;color:var(--rt);cursor:pointer;font-weight:500;}
.sh-close{font-size:18px;color:var(--tx3);cursor:pointer;}
.sh-slbl{font-size:11px;color:var(--tx2);text-transform:uppercase;letter-spacing:0.3px;padding:11px 16px 7px;font-weight:500;}
.sh-chips{display:flex;flex-wrap:wrap;gap:6px;padding:0 16px 4px;}
.schip{padding:6px 12px;border-radius:20px;font-size:12px;border:0.5px solid var(--br2);color:var(--tx2);background:var(--sf2);cursor:pointer;}
.schip.on{background:var(--pl);border-color:var(--pm);color:var(--pt);font-weight:500;}
.schip.on.col{background:var(--al);border-color:#FAC775;color:var(--at);}
.schip.on.sz{background:var(--bl);border-color:#B5D4F4;color:var(--bt);}
.schip.on.green{background:var(--gl);border-color:#C0DD97;color:var(--gt);}
.schip.on.red{background:var(--rl);border-color:#F7C1C1;color:var(--rt);}
.sh-done{margin:13px 16px 0;width:calc(100% - 32px);padding:12px;border-radius:10px;background:var(--p);color:#fff;border:none;font-size:13px;font-weight:500;cursor:pointer;display:block;}
.sh-row{display:flex;gap:7px;padding:10px 16px 0;}
.sh-row input{flex:1;border:0.5px solid var(--br2);border-radius:var(--rads);padding:8px 11px;font-size:13px;color:var(--tx);background:var(--sf2);outline:none;font-family:inherit;}
.sh-row button{padding:8px 12px;border-radius:var(--rads);background:var(--p);color:#fff;border:none;font-size:12px;font-weight:500;cursor:pointer;}

/* ─ BULK APPLY SHEET ─ */
.sh-item{display:flex;align-items:center;gap:11px;padding:12px 16px;border-bottom:0.5px solid var(--br);cursor:pointer;}
.sh-item:last-child{border-bottom:none;}
.sh-item:hover{background:var(--sf2);}
.shi-ico{width:34px;height:34px;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:17px;flex-shrink:0;}
.shi-info{flex:1;}
.shi-title{font-size:13px;font-weight:500;color:var(--tx);}
.shi-sub{font-size:11px;color:var(--tx2);margin-top:1px;}

/* ─ SYNC ─ */
.sync-step{display:flex;align-items:flex-start;gap:11px;padding:13px 14px;border-bottom:0.5px solid var(--br);}
.sync-step:last-child{border-bottom:none;}
.syn{width:24px;height:24px;border-radius:50%;background:var(--pl);color:var(--pt);font-size:11px;font-weight:500;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
.sinfo .st{font-size:13px;font-weight:500;color:var(--tx);margin-bottom:2px;}
.sinfo .sd{font-size:12px;color:var(--tx2);line-height:1.5;}
.sync-btn-el{margin-top:9px;padding:8px 14px;border-radius:var(--rads);background:var(--p);color:#fff;border:none;font-size:12px;font-weight:500;cursor:pointer;display:inline-flex;align-items:center;gap:5px;}
.upload-drop{border:0.5px dashed var(--br2);border-radius:var(--rads);padding:18px;text-align:center;background:var(--sf2);cursor:pointer;margin-top:8px;}
.upload-drop:hover{border-color:var(--p);background:var(--pl);}
.upload-drop i{font-size:22px;color:var(--tx3);display:block;margin:0 auto 5px;}
.upload-drop p{font-size:12px;color:var(--tx2);}
.sync-prev-row{display:flex;align-items:center;justify-content:space-between;padding:8px 14px;border-bottom:0.5px solid var(--br);}
.sync-prev-row:last-child{border-bottom:none;}

/* ─ BOTTOM BAR ─ */
.bbar{padding:11px 14px calc(var(--sb)+11px);background:var(--sf);border-top:0.5px solid var(--br);flex-shrink:0;}
.pri-btn{width:100%;padding:13px;border-radius:var(--rad);background:var(--p);color:#fff;border:none;font-size:14px;font-weight:500;cursor:pointer;font-family:inherit;}
.pri-btn:active{opacity:0.85;}

/* ─ TOAST ─ */
.toast{position:fixed;bottom:calc(var(--sb)+70px);left:50%;transform:translateX(-50%);background:#1A1740;color:#fff;padding:9px 18px;border-radius:20px;font-size:13px;font-weight:500;opacity:0;pointer-events:none;transition:opacity 0.2s;white-space:nowrap;z-index:999;}
.toast.show{opacity:1;}
</style>
</head>
<body>
<div class="toast" id="toast"></div>

<!-- ════════════════════ SCREEN: SETTINGS ════════════════════ -->
<div class="screen" id="s-settings">
  <div class="tb">
    <button class="tb-bk" onclick="goBack()"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M19 12H5m0 0l7-7m-7 7l7 7"/></svg></button>
    <div class="tb-info"><div class="tb-title">Variant categories</div><div class="tb-sub">Reusable size, colour and value presets</div></div>
    <div class="tb-acts"><button class="tbb white" onclick="openNewSet()">+ New set</button></div>
  </div>
  <div class="scroll-body">
    <div style="padding:10px 14px 6px;font-size:12px;color:var(--tx2);">Saved variant categories appear as quick-pick presets when you add a category to a material. System defaults can be duplicated but not deleted.</div>
    <div id="settings-sets-list" style="padding-bottom:20px;"></div>
  </div>
</div>

<!-- ════════════════════ SHEET: NEW / EDIT SET ════════════════════ -->
<div class="sh-ov" id="sh-newset">
  <div style="flex:1;" onclick="closeSheet('sh-newset')"></div>
  <div class="sh" style="max-height:88vh;overflow-y:auto;">
    <div class="sh-hdl"></div>
    <div class="sh-top" style="position:sticky;top:0;background:var(--sf);z-index:5;">
      <span class="sh-main-title" id="sh-newset-title">New variant category</span>
      <span class="sh-close" onclick="closeSheet('sh-newset')"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M18 6L6 18M6 6l12 12"/></svg></span>
    </div>
    <div style="padding:10px 16px 0;">
      <div class="lbl">Category name</div>
      <input class="inp" id="ns-cat" type="text" placeholder="e.g. Size, Colour, Length…" style="margin-top:4px;"/>
    </div>
    <div style="padding:10px 16px 0;">
      <div class="lbl">Set name</div>
      <input class="inp" id="ns-name" type="text" placeholder="e.g. Indian sizes, Festive colours…" style="margin-top:4px;"/>
    </div>
    <div style="padding:10px 16px 0;">
      <div class="lbl">Values</div>
      <div class="val-chips" id="ns-chips" style="margin-top:6px;min-height:32px;"></div>
      <div class="add-val-row" style="margin-top:8px;">
        <input class="add-val-inp" id="ns-val-inp" type="text" placeholder="Type a value and press Add…" onkeydown="if(event.key==='Enter')nsAddVal()"/>
        <button class="add-val-btn" onclick="nsAddVal()">Add</button>
      </div>
    </div>
    <button class="sh-done" onclick="saveNewSet()" style="margin-top:12px;">Save set</button>
    <div style="height:8px;"></div>
  </div>
</div>

<!-- ════════════════════ SCREEN: REPORTS ════════════════════ -->
<div class="screen" id="s-reports">
  <div class="tb">
    <button class="tb-bk" onclick="goBack()"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M19 12H5m0 0l7-7m-7 7l7 7"/></svg></button>
    <div class="tb-info"><div class="tb-title">Reports</div><div class="tb-sub">Materials and inventory</div></div>
  </div>
  <div class="scroll-body">
    <div style="padding:10px 12px 6px;font-size:11px;font-weight:500;color:var(--tx2);text-transform:uppercase;letter-spacing:0.3px;">Inventory reports</div>
    <div id="rpt-list">
      <div class="rpt-card" onclick="openReport('stock-summary')">
        <div class="rpt-icon" style="background:var(--pl);"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--p)" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16zM3.27 6.96L12 12.01l8.73-5.05M12 22.08V12"/></svg></div>
        <div class="rpt-info"><div class="rpt-title">Stock summary</div><div class="rpt-sub">Total stock per material and variant across all locations</div></div>
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="var(--tx3)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18l6-6-6-6"/></svg>
      </div>
      <div class="rpt-card" onclick="openReport('low-stock')">
        <div class="rpt-icon" style="background:var(--rl);"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--r)" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0zM12 9v4M12 17h.01"/></svg></div>
        <div class="rpt-info"><div class="rpt-title">Low stock alert</div><div class="rpt-sub">Variants at or below minimum quantity threshold</div></div>
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="var(--tx3)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18l6-6-6-6"/></svg>
      </div>
      <div class="rpt-card" onclick="openReport('zero-stock')">
        <div class="rpt-icon" style="background:var(--rl);"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--r)" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4l16 16M14 2H6a2 2 0 0 0-2 2v3M8 21h10a2 2 0 0 0 2-2V8"/></svg></div>
        <div class="rpt-info"><div class="rpt-title">Out of stock</div><div class="rpt-sub">All variants with zero stock</div></div>
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="var(--tx3)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18l6-6-6-6"/></svg>
      </div>
      <div class="rpt-card" onclick="openReport('vendor-wise')">
        <div class="rpt-icon" style="background:var(--al);"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--a)" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2zM9 22V12h6v10"/></svg></div>
        <div class="rpt-info"><div class="rpt-title">Vendor-wise inventory</div><div class="rpt-sub">Stock grouped by vendor with lead times</div></div>
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="var(--tx3)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18l6-6-6-6"/></svg>
      </div>
      <div class="rpt-card" onclick="openReport('movement')">
        <div class="rpt-icon" style="background:var(--gl);"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--g)" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14M19 12l-7 7-7-7"/></svg></div>
        <div class="rpt-info"><div class="rpt-title">Stock movement log</div><div class="rpt-sub">In / out / adjustment history with running balance</div></div>
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="var(--tx3)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18l6-6-6-6"/></svg>
      </div>
      <div class="rpt-card" onclick="openReport('valuation')">
        <div class="rpt-icon" style="background:var(--bl);"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--b)" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2a10 10 0 1 0 0 20A10 10 0 0 0 12 2zm0 6v4l3 3M12 6v.01"/></svg></div>
        <div class="rpt-info"><div class="rpt-title">Inventory valuation</div><div class="rpt-sub">Total cost value of current stock by material type</div></div>
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="var(--tx3)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18l6-6-6-6"/></svg>
      </div>
    </div>
    <div id="rpt-output" style="display:none;margin:10px 12px 0;"></div>
  </div>
</div>

<!-- ════════════════════ DRAWER: NAV ════════════════════ -->
<div class="sh-ov" id="sh-nav" style="flex-direction:row;justify-content:flex-start;align-items:stretch;">
  <div class="nav-drawer">
    <div class="nav-drawer-hdr">
      <div style="display:flex;align-items:center;gap:10px;">
        <div style="width:36px;height:36px;border-radius:10px;background:var(--pl);display:flex;align-items:center;justify-content:center;flex-shrink:0;"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--p)" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20.38 3.46L16 2a4 4 0 0 1-8 0L3.62 3.46a2 2 0 0 0-1.34 2.23l.58 3.57a1 1 0 0 0 .99.84H6v10a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V10h2.15a1 1 0 0 0 .99-.84l.58-3.57a2 2 0 0 0-1.34-2.23z"/></svg></div>
        <div>
          <div style="font-size:14px;font-weight:600;color:var(--tx);">BoutiqBiz</div>
          <div style="font-size:11px;color:var(--tx2);">VB Asansol</div>
        </div>
      </div>
      <button onclick="closeSheet('sh-nav')" style="width:30px;height:30px;border-radius:50%;border:0.5px solid var(--br2);background:var(--sf2);cursor:pointer;display:flex;align-items:center;justify-content:center;"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="var(--tx2)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6L6 18M6 6l12 12"/></svg></button>
    </div>

    <div style="padding:8px 0;">

      <!-- Inventory section -->
      <div class="nav-sec-hdr" id="navsec-inv-hdr" onclick="toggleNavSec('inv')">
        Inventory
        <svg class="chev" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
      </div>
      <div class="nav-sec-body" id="navsec-inv" style="max-height:300px;">
        <div class="nav-item on" id="nav-materials" onclick="navGo('list')">
        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20.38 3.46L16 2a4 4 0 0 1-8 0L3.62 3.46a2 2 0 0 0-1.34 2.23l.58 3.57a1 1 0 0 0 .99.84H6v10a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V10h2.15a1 1 0 0 0 .99-.84l.58-3.57a2 2 0 0 0-1.34-2.23z"/></svg>
        <span>Materials</span>
      </div>
      <div class="nav-item" id="nav-labels" onclick="navGo('labels')">
        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
        <span>Print Labels</span>
      </div>
      <div class="nav-item" id="nav-reports" onclick="navGo('reports')">
        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8zM14 2v6h6M16 13H8M16 17H8M10 9H8"/></svg>
        <span>Reports</span>
      </div>
      <div class="nav-item" id="nav-collections" onclick="navGo('collections')">
        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/><line x1="12" y1="12" x2="12" y2="16"/><line x1="10" y1="14" x2="14" y2="14"/></svg>
        <span>Collections</span>
      </div>
      </div><!-- /navsec-inv -->
      <!-- Tools section -->
      <div class="nav-sec-hdr" id="navsec-tools-hdr" onclick="toggleNavSec('tools')">
        Tools
        <svg class="chev" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
      </div>
      <div class="nav-sec-body" id="navsec-tools" style="max-height:300px;">
      <div class="nav-item" id="nav-sync" onclick="navGo('sync')">
        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4v5h5M20 20v-5h-5M20.49 9A9 9 0 0 0 5.64 5.64L4 9M3.51 15a9 9 0 0 0 14.85 3.36L20 15"/></svg>
        <span>Sync inventory</span>
      </div>
      <div class="nav-item" id="nav-import" onclick="closeSheet('sh-nav');openSheet('sh-shopify')">
        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M6 17.5l9 2 3.5-15.5-2-.5s0-1.5-2-2-2.5.5-2.5.5l-1-.5-5 16z"/></svg>
        <span>Import from Shopify</span>
      </div>
    </div>

    <div style="height:0.5px;background:var(--br);margin:0 16px;"></div>

    <div style="padding:8px 0;">
      <div style="padding:6px 18px 4px;font-size:10px;font-weight:500;color:var(--tx3);text-transform:uppercase;letter-spacing:0.4px;">Settings</div>
      </div><!-- /navsec-tools -->
      <!-- Settings section -->
      <div class="nav-sec-hdr" id="navsec-cfg-hdr" onclick="toggleNavSec('cfg')">
        Settings
        <svg class="chev" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
      </div>
      <div class="nav-sec-body" id="navsec-cfg" style="max-height:300px;">
      <div class="nav-item" id="nav-settings" onclick="navGo('settings')">
        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm0-5a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/></svg>
        <span>Variant categories</span>
      </div>
    </div>
  </div>
  <div style="flex:1;" onclick="closeSheet('sh-nav')"></div>
</div>

<!-- ════════════════════ SCREEN: COLLECTIONS ════════════════════ -->
<div class="screen" id="s-collections">
  <div class="tb">
    <div class="tb-acts" style="justify-content:flex-start;gap:8px;">
      <button class="tbb ghost" onclick="openSheet('sh-nav')" aria-label="Menu"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 12h18M3 6h18M3 18h18"/></svg></button>
    </div>
    <div class="tb-info"><div class="tb-title">Collections</div><div class="tb-sub" id="col-sub">0 collections</div></div>
    <div class="tb-acts">
      <button class="tbb primary" onclick="openColEdit(null)">+ New</button>
    </div>
  </div>
  <div style="padding:12px 12px 0;" id="col-list"></div>
</div>

<!-- SHEET: ADD TO COLLECTION -->
<div class="sh-ov" id="sh-addtocol">
  <div style="flex:1;" onclick="closeSheet('sh-addtocol')"></div>
  <div class="sh" style="max-height:80vh;overflow-y:auto;">
    <div class="sh-hdl"></div>
    <div class="sh-top" style="position:sticky;top:0;background:var(--sf);z-index:5;">
      <span class="sh-main-title">Add to collection</span>
      <span class="sh-close" onclick="closeSheet('sh-addtocol')"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6L6 18M6 6l12 12"/></svg></span>
    </div>
    <div id="sh-addtocol-body" style="padding:4px 0 16px;"></div>
    <div style="padding:0 14px 8px;">
      <button onclick="openColEdit(null)" style="width:100%;padding:10px;border-radius:var(--rads);background:var(--sf2);border:0.5px dashed var(--br2);color:var(--tx2);font-size:13px;cursor:pointer;font-family:inherit;">+ New collection</button>
    </div>
  </div>
</div>

<!-- SHEET: CREATE / EDIT COLLECTION -->
<div class="sh-ov" id="sh-coledit">
  <div style="flex:1;" onclick="closeSheet('sh-coledit')"></div>
  <div class="sh" style="max-height:92vh;overflow-y:auto;">
    <div class="sh-hdl"></div>
    <div class="sh-top" style="position:sticky;top:0;background:var(--sf);z-index:5;">
      <span class="sh-main-title" id="sh-coledit-title">New collection</span>
      <span class="sh-close" onclick="closeSheet('sh-coledit')"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6L6 18M6 6l12 12"/></svg></span>
    </div>
    <div style="padding:12px 14px;display:flex;flex-direction:column;gap:14px;">
      <!-- Name -->
      <div>
        <div class="lbl">Collection name *</div>
        <input id="col-name-inp" class="inp" type="text" placeholder="e.g. Summer Festive 2025"/>
      </div>
      <!-- Desc -->
      <div>
        <div class="lbl">Description</div>
        <textarea id="col-desc-inp" class="inp" rows="2" placeholder="Short description…" style="resize:none;font-family:inherit;"></textarea>
      </div>
      <!-- Color -->
      <div>
        <div class="lbl">Colour label</div>
        <div style="display:flex;gap:8px;flex-wrap:wrap;" id="col-color-row">
          <!-- rendered by JS -->
        </div>
      </div>
      <!-- Tag rules -->
      <div>
        <div class="lbl" style="margin-bottom:4px;">Auto-include by tags</div>
        <div style="font-size:11px;color:var(--tx3);margin-bottom:8px;">Products matching ANY of these tags are automatically included.</div>
        <div id="col-tag-chips" style="display:flex;flex-wrap:wrap;gap:6px;margin-bottom:8px;min-height:20px;"></div>
        <div style="display:flex;gap:6px;">
          <input id="col-tag-inp" class="inp" type="text" placeholder="Add tag…" style="flex:1;" onkeydown="if(event.key==='Enter'){addColTag();event.preventDefault();}"/>
          <button onclick="addColTag()" style="padding:8px 12px;border-radius:var(--rads);background:var(--p);color:#fff;border:none;cursor:pointer;font-size:12px;font-family:inherit;">Add</button>
        </div>
        <div id="col-tag-suggestions" style="margin-top:8px;"></div>
      </div>
      <!-- Manual products -->
      <div>
        <div class="lbl" style="margin-bottom:4px;">Manual products</div>
        <div style="font-size:11px;color:var(--tx3);margin-bottom:8px;">Pick products to always include regardless of tags.</div>
        <div id="col-manual-list" style="display:flex;flex-direction:column;gap:6px;max-height:220px;overflow-y:auto;border:0.5px solid var(--br);border-radius:var(--rads);padding:6px 10px;background:var(--sf2);"></div>
      </div>
      <!-- Preview -->
      <div id="col-preview-section">
        <div class="lbl" style="margin-bottom:6px;">Preview <span id="col-preview-count" style="font-size:11px;color:var(--tx3);font-weight:400;"></span></div>
        <div id="col-preview-list" style="display:flex;flex-direction:column;gap:5px;max-height:150px;overflow-y:auto;"></div>
      </div>
    </div>
    <div style="padding:8px 14px 20px;display:flex;gap:8px;">
      <button id="col-del-btn" onclick="deleteCollection()" style="padding:10px 16px;border-radius:var(--rads);background:var(--rl);color:var(--rt);border:0.5px solid var(--rm);font-size:13px;font-weight:500;cursor:pointer;font-family:inherit;display:none;">Delete</button>
      <button onclick="saveCollection()" style="flex:1;padding:11px;border-radius:var(--rads);background:var(--p);color:#fff;border:none;font-size:14px;font-weight:500;cursor:pointer;font-family:inherit;">Save collection</button>
    </div>
  </div>
</div>

<!-- ════════════════════ SCREEN: LIST ════════════════════ -->
<div class="screen on" id="s-list">
  <div class="tb">
    <button class="tbb ghost" onclick="openSheet('sh-nav')" aria-label="Menu" style="flex-shrink:0;"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 12h18M3 6h18M3 18h18"/></svg></button>
    <div class="tb-info"><div class="tb-title">Materials</div><div class="tb-sub" id="list-sub">VB Asansol</div></div>
    <div class="tb-acts">
      <button class="tbb ghost" onclick="openColToggle()" title="Columns" aria-label="Columns"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3h7a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-7m0-18H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h7m0-18v18"/></svg></button>
      <div class="view-toggle" id="view-toggle">
        <button class="vtb on" id="vtb-list" onclick="setView('list')" title="List" aria-label="List view"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg></button>
        <button class="vtb" id="vtb-gallery" onclick="setView('gallery')" title="Gallery" aria-label="Gallery view"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg></button>
        <button class="vtb" id="vtb-large" onclick="setView('large')" title="Large cards" aria-label="Large card view"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M9 21V9"/></svg></button>
      </div>
      <button class="tbb white" onclick="openCreate()">+ Add</button>
    </div>
  </div>
  <div class="list-ctrl">
    <div class="srch"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/></svg><input type="text" placeholder="Search materials, SKUs…" oninput="searchList(this.value)"/></div>
    <div class="filt-btn" id="filt-btn" onclick="toggleFilterPanel()"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 3H2l8 9.46V19l4 2v-8.54L22 3z"/></svg><span id="filt-lbl">Filter</span></div>
  </div>

  <!-- CUSTOM TABS ROW -->
  <div id="ctabs-row" style="background:var(--sf);border-bottom:0.5px solid var(--br);display:flex;align-items:center;overflow-x:auto;flex-shrink:0;padding:0 12px;">
    <div class="ctab-pill ctab-active" id="ctab-all" onclick="setCustomTab(null)">All</div>
    <!-- dynamic tabs injected here by renderCustomTabs() -->
    <div id="ctab-dynamic"></div>
    <button class="ctab-add" onclick="openNewTabSheet()" title="New tab">
      <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14M5 12h14"/></svg> New tab
    </button>
  </div>

  <!-- INLINE FILTER PANEL (Advanced) -->
  <div id="filter-panel" style="display:none;background:var(--sf);border-bottom:0.5px solid var(--br);flex-shrink:0;max-height:72vh;overflow-y:auto;">

    <!-- Quick search inside filter -->
    <div class="fp-search">
      <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="var(--tx3)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/></svg>
      <input type="text" placeholder="Filter by keyword, SKU, tag…" oninput="activeF.keyword=this.value;renderActiveFilters()"/>
    </div>

    <!-- Material type -->
    <div class="fp-group" id="fpg-type">
      <div class="fp-hdr" onclick="toggleFPGroup('type')">
        <span class="fp-lbl">Material type</span>
        <span class="fp-val" id="fpv-type">Any</span>
        <svg class="fp-arr" id="fpa-type" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
      </div>
      <div class="fp-body" id="fpb-type" style="display:none;">
        <label class="fp-check"><input type="checkbox" id="fc-finished" onchange="toggleFPCheck('type','finished',this.checked)"/> Finished good</label>
        <label class="fp-check"><input type="checkbox" id="fc-raw" onchange="toggleFPCheck('type','raw',this.checked)"/> Raw material</label>
        <label class="fp-check"><input type="checkbox" id="fc-production" onchange="toggleFPCheck('type','production',this.checked)"/> Production material</label>
      </div>
    </div>

    <!-- Stock status -->
    <div class="fp-group" id="fpg-stock">
      <div class="fp-hdr" onclick="toggleFPGroup('stock')">
        <span class="fp-lbl">Stock status</span>
        <span class="fp-val" id="fpv-stock">Any</span>
        <svg class="fp-arr" id="fpa-stock" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
      </div>
      <div class="fp-body" id="fpb-stock" style="display:none;">
        <label class="fp-check"><input type="checkbox" onchange="toggleFPCheck('stockStatus','in-stock',this.checked)"/> In stock</label>
        <label class="fp-check"><input type="checkbox" onchange="toggleFPCheck('stockStatus','low-stock',this.checked)"/> Low stock (at or below min)</label>
        <label class="fp-check"><input type="checkbox" onchange="toggleFPCheck('stockStatus','out-of-stock',this.checked)"/> Out of stock</label>
      </div>
    </div>

    <!-- Quantity range -->
    <div class="fp-group" id="fpg-qty">
      <div class="fp-hdr" onclick="toggleFPGroup('qty')">
        <span class="fp-lbl">Quantity range</span>
        <span class="fp-val" id="fpv-qty">Any</span>
        <svg class="fp-arr" id="fpa-qty" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
      </div>
      <div class="fp-body" id="fpb-qty" style="display:none;">
        <div class="fp-range">
          <input type="number" id="fq-min" min="0" placeholder="Min qty" oninput="activeF.qmin=parseInt(this.value)||null;updateFPBadge('qty')"/>
          <input type="number" id="fq-max" min="0" placeholder="Max qty" oninput="activeF.qmax=parseInt(this.value)||null;updateFPBadge('qty')"/>
        </div>
      </div>
    </div>

    <!-- Vendor -->
    <div class="fp-group" id="fpg-vendor">
      <div class="fp-hdr" onclick="toggleFPGroup('vendor')">
        <span class="fp-lbl">Vendor / Supplier</span>
        <span class="fp-val" id="fpv-vendor">Any</span>
        <svg class="fp-arr" id="fpa-vendor" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
      </div>
      <div class="fp-body" id="fpb-vendor" style="display:none;">
        <div id="fpb-vendor-list"></div>
      </div>
    </div>

    <!-- Collection -->
    <div class="fp-group" id="fpg-col">
      <div class="fp-hdr" onclick="toggleFPGroup('col')">
        <span class="fp-lbl">Collection</span>
        <span class="fp-val" id="fpv-col">Any</span>
        <svg class="fp-arr" id="fpa-col" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
      </div>
      <div class="fp-body" id="fpb-col" style="display:none;">
        <div id="fpb-col-list"></div>
      </div>
    </div>

    <!-- Price / cost range -->
    <div class="fp-group" id="fpg-price">
      <div class="fp-hdr" onclick="toggleFPGroup('price')">
        <span class="fp-lbl">MRP range</span>
        <span class="fp-val" id="fpv-price">Any</span>
        <svg class="fp-arr" id="fpa-price" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
      </div>
      <div class="fp-body" id="fpb-price" style="display:none;">
        <div class="fp-range">
          <input type="number" placeholder="Min ₹" oninput="activeF.priceMin=parseInt(this.value)||null;updateFPBadge('price')"/>
          <input type="number" placeholder="Max ₹" oninput="activeF.priceMax=parseInt(this.value)||null;updateFPBadge('price')"/>
        </div>
      </div>
    </div>

    <!-- Variant count -->
    <div class="fp-group" id="fpg-varcount">
      <div class="fp-hdr" onclick="toggleFPGroup('varcount')">
        <span class="fp-lbl">Variant count</span>
        <span class="fp-val" id="fpv-varcount">Any</span>
        <svg class="fp-arr" id="fpa-varcount" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
      </div>
      <div class="fp-body" id="fpb-varcount" style="display:none;">
        <label class="fp-radio" style="display:flex;align-items:center;gap:8px;padding:9px 14px;font-size:13px;color:var(--tx);cursor:pointer;"><input type="radio" name="varcount" value="" checked onchange="setFPVarcount('')"/> Any</label>
        <label class="fp-radio" style="display:flex;align-items:center;gap:8px;padding:9px 14px;font-size:13px;color:var(--tx);cursor:pointer;"><input type="radio" name="varcount" value="single" onchange="setFPVarcount('single')"/> Single variant only</label>
        <label class="fp-radio" style="display:flex;align-items:center;gap:8px;padding:9px 14px;font-size:13px;color:var(--tx);cursor:pointer;"><input type="radio" name="varcount" value="multi" onchange="setFPVarcount('multi')"/> Multiple variants</label>
      </div>
    </div>

    <!-- Has images -->
    <div class="fp-group" id="fpg-images">
      <div class="fp-hdr" onclick="toggleFPGroup('images')">
        <span class="fp-lbl">Product images</span>
        <span class="fp-val" id="fpv-images">Any</span>
        <svg class="fp-arr" id="fpa-images" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
      </div>
      <div class="fp-body" id="fpb-images" style="display:none;">
        <label class="fp-radio" style="display:flex;align-items:center;gap:8px;padding:9px 14px;font-size:13px;color:var(--tx);cursor:pointer;"><input type="radio" name="hasimg" value="" checked onchange="activeF.hasImages=null;updateFPBadge('images')"/> Any</label>
        <label class="fp-radio" style="display:flex;align-items:center;gap:8px;padding:9px 14px;font-size:13px;color:var(--tx);cursor:pointer;"><input type="radio" name="hasimg" value="yes" onchange="activeF.hasImages=true;updateFPBadge('images')"/> Has images</label>
        <label class="fp-radio" style="display:flex;align-items:center;gap:8px;padding:9px 14px;font-size:13px;color:var(--tx);cursor:pointer;"><input type="radio" name="hasimg" value="no" onchange="activeF.hasImages=false;updateFPBadge('images')"/> No images</label>
      </div>
    </div>

    <!-- Sort -->
    <div class="fp-group" id="fpg-sort" style="border-bottom:none;">
      <div class="fp-hdr" onclick="toggleFPGroup('sort')">
        <span class="fp-lbl">Sort by</span>
        <span class="fp-val" id="fpv-sort">Name A–Z</span>
        <svg class="fp-arr" id="fpa-sort" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
      </div>
      <div class="fp-body" id="fpb-sort" style="display:none;">
        <label class="fp-radio" style="display:flex;align-items:center;gap:8px;padding:9px 14px;font-size:13px;cursor:pointer;"><input type="radio" name="sortby" value="name" checked onchange="setFPSort('name','Name A–Z')"/> Name A–Z</label>
        <label class="fp-radio" style="display:flex;align-items:center;gap:8px;padding:9px 14px;font-size:13px;cursor:pointer;"><input type="radio" name="sortby" value="name-z" onchange="setFPSort('name-z','Name Z–A')"/> Name Z–A</label>
        <label class="fp-radio" style="display:flex;align-items:center;gap:8px;padding:9px 14px;font-size:13px;cursor:pointer;"><input type="radio" name="sortby" value="qty-lo" onchange="setFPSort('qty-lo','Stock: low first')"/> Stock: low first</label>
        <label class="fp-radio" style="display:flex;align-items:center;gap:8px;padding:9px 14px;font-size:13px;cursor:pointer;"><input type="radio" name="sortby" value="qty-hi" onchange="setFPSort('qty-hi','Stock: high first')"/> Stock: high first</label>
        <label class="fp-radio" style="display:flex;align-items:center;gap:8px;padding:9px 14px;font-size:13px;cursor:pointer;"><input type="radio" name="sortby" value="new" onchange="setFPSort('new','Recently added')"/> Recently added</label>
        <label class="fp-radio" style="display:flex;align-items:center;gap:8px;padding:9px 14px;font-size:13px;cursor:pointer;"><input type="radio" name="sortby" value="price-hi" onchange="setFPSort('price-hi','Price: high first')"/> Price: high first</label>
        <label class="fp-radio" style="display:flex;align-items:center;gap:8px;padding:9px 14px;font-size:13px;cursor:pointer;"><input type="radio" name="sortby" value="vars" onchange="setFPSort('vars','Most variants')"/> Most variants</label>
      </div>
    </div>

    <div style="display:flex;gap:8px;padding:10px 12px 12px;">
      <button onclick="clearFilters()" style="flex:1;padding:9px;border-radius:var(--rads);background:var(--sf2);border:0.5px solid var(--br2);color:var(--tx2);font-size:13px;font-weight:500;cursor:pointer;font-family:inherit;">Clear all</button>
      <button onclick="applyFilters()" style="flex:2;padding:9px;border-radius:var(--rads);background:var(--p);border:none;color:#fff;font-size:13px;font-weight:500;cursor:pointer;font-family:inherit;">Apply filters</button>
    </div>
  </div>

  <div id="af-bar" class="active-filter-bar"></div>
  <div class="list-meta" id="list-meta"></div>
  <div class="scroll-body"><div id="mat-list" style="padding-bottom:16px;"></div></div>
</div>

<!-- ════════════════════ SCREEN: CREATE/EDIT ════════════════════ -->
<div class="screen" id="s-create">
  <div class="tb">
    <button class="tb-bk" onclick="goBack()"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M19 12H5m0 0l7-7m-7 7l7 7"/></svg></button>
    <div class="tb-info"><div class="tb-title" id="create-title">New material</div></div>
    <div class="tb-acts"><button class="tbb white" onclick="saveMaterial()">Save</button></div>
  </div>
  <div class="tab-strip">
    <div class="tab-inner">
      <div class="tab on" id="ctab-0" onclick="setCTab(0)">Info</div>
      <div class="tab" id="ctab-1" onclick="setCTab(1)">Movement</div>
      <div class="tab" id="ctab-2" onclick="setCTab(2)">Supply</div>
    </div>
  </div>
  <div class="scroll-body">
    <div id="cpg-0"></div>
    <div id="cpg-1" style="display:none;"></div>
    <div id="cpg-2" style="display:none;"></div>
  </div>
</div>

<!-- ════════════════════ SCREEN: MATERIAL DETAIL ════════════════════ -->
<div class="screen" id="s-mdetail">
  <div class="tb">
    <button class="tb-bk" onclick="goBack()"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M19 12H5m0 0l7-7m-7 7l7 7"/></svg></button>
    <div class="tb-info"><div class="tb-title" id="md-title">Material detail</div></div>
    <div class="tb-acts"><button class="tbb white" onclick="editCurrentMat()">Edit</button></div>
  </div>
  <div class="tab-strip">
    <div class="tab-inner">
      <div class="tab on" id="mdtab-0" onclick="setMDTab(0)">Overview</div>
      <div class="tab" id="mdtab-1" onclick="setMDTab(1)">Variants</div>
      <div class="tab" id="mdtab-2" onclick="setMDTab(2)">Inventory</div>
      <div class="tab" id="mdtab-3" onclick="setMDTab(3)">Supply</div>
    </div>
  </div>
  <div class="scroll-body">
    <div id="mdpg-0"></div>
    <div id="mdpg-1" style="display:none;"></div>
    <div id="mdpg-2" style="display:none;"></div>
    <div id="mdpg-3" style="display:none;"></div>
  </div>
</div>

<!-- SHEET: ADD MOVEMENT -->
<div class="sh-ov" id="sh-movement" onclick="if(event.target===this)closeSheet('sh-movement')">
  <div style="flex:1;"></div>
  <div class="sh">
    <div class="sh-hdl"></div>
    <div class="sh-top">
      <span class="sh-main-title">Add movement</span>
      <span class="sh-close" onclick="closeSheet('sh-movement')"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M18 6L6 18M6 6l12 12"/></svg></span>
    </div>
    <div style="padding:12px 16px 0;">
      <div class="lbl">Movement type</div>
      <div class="mv-type-grid" id="mv-type-row">
        <button class="mv-type-btn mv-on-g" onclick="setMvType('IN',this)" data-mv="IN">↑ Stock IN<br><span style="font-size:9px;font-weight:400;">received from vendor</span></button>
        <button class="mv-type-btn" onclick="setMvType('OUT',this)" data-mv="OUT">↓ Stock OUT<br><span style="font-size:9px;font-weight:400;">dispatched / sold</span></button>
        <button class="mv-type-btn" onclick="setMvType('PO',this)" data-mv="PO">📦 Purchase<br><span style="font-size:9px;font-weight:400;">purchase order received</span></button>
        <button class="mv-type-btn" onclick="setMvType('PROD',this)" data-mv="PROD">🏭 Used in Prod<br><span style="font-size:9px;font-weight:400;">consumed in production</span></button>
        <button class="mv-type-btn" onclick="setMvType('JOB',this)" data-mv="JOB">🔀 Jobber IN/OUT<br><span style="font-size:9px;font-weight:400;">sent/received from jobber</span></button>
        <button class="mv-type-btn" onclick="setMvType('ADJ',this)" data-mv="ADJ">⇆ Adjustment<br><span style="font-size:9px;font-weight:400;">manual stock correction</span></button>
      </div>
      <input type="hidden" id="mv-type" value="IN"/>
    </div>
    <div style="padding:10px 16px 0;">
      <div class="lbl">Variant</div>
      <select class="inp" id="mv-variant" style="margin-top:4px;"></select>
    </div>
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;padding:10px 16px 0;">
      <div><div class="lbl">Quantity</div><input class="inp" id="mv-qty" type="number" min="1" value="1" placeholder="0" style="margin-top:4px;"/></div>
      <div><div class="lbl">Date</div><input class="inp" id="mv-date" type="date" style="margin-top:4px;"/></div>
    </div>
    <div style="padding:10px 16px 0;">
      <div class="lbl">Reference / PO number</div>
      <input class="inp" id="mv-ref" type="text" placeholder="e.g. PO-1234" style="margin-top:4px;"/>
    </div>
    <div style="padding:10px 16px 0;">
      <div class="lbl">Notes</div>
      <textarea class="inp" id="mv-notes" rows="2" placeholder="Optional notes…" style="margin-top:4px;resize:none;font-family:inherit;"></textarea>
    </div>
    <button class="sh-done" onclick="saveMovement()" style="margin-top:12px;">Save movement</button>
    <div style="height:8px;"></div>
  </div>
</div>

<!-- ════════════════════ SCREEN: VARIANT DETAIL ════════════════════ -->
<div class="screen" id="s-vdetail">
  <div class="tb">
    <button class="tb-bk" onclick="goBack()"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M19 12H5m0 0l7-7m-7 7l7 7"/></svg></button>
    <div class="tb-info"><div class="tb-title" id="vd-title">Variant detail</div></div>
    <div class="tb-acts"><button class="tbb white" onclick="saveVD()">Save</button></div>
  </div>
  <div class="tab-strip">
    <div class="tab-inner">
      <div class="tab on" id="vtab-0" onclick="setVTab(0)">Pricing</div>
      <div class="tab" id="vtab-1" onclick="setVTab(1)">Inventory</div>
      <div class="tab" id="vtab-2" onclick="setVTab(2)">Techpack</div>
    </div>
  </div>
  <div class="scroll-body">
    <div id="vpg-0"></div>
    <div id="vpg-1" style="display:none;"></div>
    <div id="vpg-2" style="display:none;"></div>
  </div>
</div>

<!-- ════════════════════ SCREEN: SYNC ════════════════════ -->
<div class="screen" id="s-sync">
  <div class="tb">
    <button class="tb-bk" onclick="goBack()"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M19 12H5m0 0l7-7m-7 7l7 7"/></svg></button>
    <div class="tb-info"><div class="tb-title">Sync inventory</div><div class="tb-sub">Download · Fill · Upload</div></div>
    <div class="tb-acts"><button class="tbb white" onclick="downloadCSV()">Download CSV</button></div>
  </div>
  <div class="scroll-body">
    <div style="padding:11px 14px 6px;font-size:13px;color:var(--tx2);">Download your inventory sheet, update the New Qty column, and re-upload to sync all quantities at once.</div>
    <div class="sec">
      <div class="sync-step"><div class="syn">1</div><div class="sinfo"><div class="st">Download template</div><div class="sd">CSV with all materials, variants, SKUs and current stock.</div><button class="sync-btn-el" onclick="downloadCSV()"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M7 10l5 5 5-5M12 15V3"/></svg> Download inventory.csv</button></div></div>
      <div class="sync-step"><div class="syn">2</div><div class="sinfo"><div class="st">Fill in new quantities</div><div class="sd">Open in Excel or Google Sheets. Update the New Qty column only. Do not change SKU or Material ID.</div></div></div>
      <div class="sync-step"><div class="syn">3</div><div class="sinfo"><div class="st">Upload updated sheet</div><div class="sd">Re-upload the CSV to sync quantities across all variants.</div><div class="upload-drop" onclick="document.getElementById('sync-inp').click()"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M17 8l-5-5-5 5M12 3v12"/></svg><p>Tap to choose CSV file</p></div><input type="file" id="sync-inp" accept=".csv" onchange="handleSync(this)"/></div></div>
    </div>
    <div id="sync-prev" style="display:none;margin:10px 12px 0;">
      <div style="display:flex;align-items:center;justify-content:space-between;padding:11px 14px;background:var(--sf);border-radius:var(--rad);border:0.5px solid var(--br);margin-bottom:6px;"><span style="font-size:13px;font-weight:500;" id="sync-prev-title">Preview</span><span style="font-size:12px;color:var(--p);cursor:pointer;font-weight:500;" onclick="confirmSync()">Apply sync →</span></div>
      <div id="sync-prev-rows" style="background:var(--sf);border-radius:var(--rad);border:0.5px solid var(--br);overflow:hidden;margin-bottom:16px;"></div>
    </div>
  </div>
</div>

<!-- ════════════════════ SHEET: FILTER ════════════════════ -->
<!-- SHEET: TAG -->
<div class="sh-ov" id="sh-tag">
  <div style="flex:1;" onclick="closeSheet('sh-tag')"></div>
  <div class="sh">
    <div class="sh-hdl"></div>
    <div class="sh-top"><span class="sh-main-title">Tag — <span id="sh-tag-name" style="color:var(--p);">Variant</span></span><span class="sh-close" onclick="closeSheet('sh-tag')"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M18 6L6 18M6 6l12 12"/></svg></span></div>
    <div class="sh-slbl">Color</div>
    <div class="sh-chips" id="sh-color-chips">
      <div class="schip col" onclick="toggleChip(this,'col')">Brown · Sabrang</div>
      <div class="schip col" onclick="toggleChip(this,'col')">Blue</div>
      <div class="schip col" onclick="toggleChip(this,'col')">Black</div>
      <div class="schip col" onclick="toggleChip(this,'col')">Red</div>
      <div class="schip col" onclick="toggleChip(this,'col')">Maroon</div>
      <div class="schip col" onclick="toggleChip(this,'col')">Mustard</div>
      <div class="schip col" onclick="toggleChip(this,'col')">Khaki</div>
    </div>
    <div class="sh-slbl">Size</div>
    <div class="sh-chips" id="sh-sz-chips">
      <div class="schip sz" onclick="toggleChip(this,'sz')">Free size</div>
      <div class="schip sz" onclick="toggleChip(this,'sz')">XS</div>
      <div class="schip sz" onclick="toggleChip(this,'sz')">S</div>
      <div class="schip sz" onclick="toggleChip(this,'sz')">M</div>
      <div class="schip sz" onclick="toggleChip(this,'sz')">L</div>
      <div class="schip sz" onclick="toggleChip(this,'sz')">XL</div>
      <div class="schip sz" onclick="toggleChip(this,'sz')">XXL</div>
    </div>
    <div class="sh-slbl">Custom tag</div>
    <div class="sh-row"><input type="text" id="ctag-inp" placeholder="e.g. Handwoven, Embroidered…" onkeydown="if(event.key==='Enter')addCustomTag()"/><button onclick="addCustomTag()">Add</button></div>
    <button class="sh-done" onclick="closeSheet('sh-tag')">Done</button>
  </div>
</div>

<!-- SHEET: VARIANT IMAGE MANAGER -->
<div class="sh-ov" id="sh-varimg">
  <div style="flex:1;" onclick="closeSheet('sh-varimg')"></div>
  <div class="sh" style="max-height:88vh;display:flex;flex-direction:column;">
    <div class="sh-hdl"></div>
    <div class="sh-top" style="position:sticky;top:0;background:var(--sf);z-index:5;">
      <div>
        <div class="sh-main-title" id="sh-varimg-title">Variant images</div>
        <div style="font-size:11px;color:var(--tx2);margin-top:2px;" id="sh-varimg-sub">Tap to set as cover · long-press to remove</div>
      </div>
      <span class="sh-close" onclick="closeSheet('sh-varimg')"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M18 6L6 18M6 6l12 12"/></svg></span>
    </div>

    <!-- Variant-specific images -->
    <div style="flex:1;overflow-y:auto;padding-bottom:12px;">
      <div style="padding:11px 14px 6px;font-size:11px;font-weight:500;color:var(--tx2);text-transform:uppercase;letter-spacing:0.3px;">Variant images</div>
      <div id="vi-own-grid" style="display:grid;grid-template-columns:repeat(3,1fr);gap:8px;padding:0 14px;"></div>

      <!-- Upload zone for variant -->
      <div style="margin:10px 14px 0;border:0.5px dashed var(--br2);border-radius:var(--rads);padding:14px;text-align:center;cursor:pointer;background:var(--sf2);" onclick="document.getElementById('vi-img-inp').click()">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--tx3)" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" style="display:block;margin:0 auto 5px;"><path d="M21 15V8a2 2 0 0 0-2-2h-3l-2-2h-4L8 6H5a2 2 0 0 0-2 2v11a2 2 0 0 0 2 2h7M16 19l3-3 3 3M19 16v6"/></svg>
        <div style="font-size:13px;font-weight:500;color:var(--tx);">Upload variant images</div>
        <div style="font-size:11px;color:var(--tx3);margin-top:2px;">JPEG, PNG · assigned to this variant only</div>
      </div>
      <input type="file" id="vi-img-inp" accept="image/*" multiple style="display:none;" onchange="handleVarImgUpload(this)"/>

      <!-- Product images to tag -->
      <div style="padding:13px 14px 6px;font-size:11px;font-weight:500;color:var(--tx2);text-transform:uppercase;letter-spacing:0.3px;">From product gallery</div>
      <div style="padding:0 14px 2px;font-size:12px;color:var(--tx3);" id="vi-gallery-empty" style="display:none;">No product images uploaded yet.</div>
      <div id="vi-gallery-grid" style="display:grid;grid-template-columns:repeat(3,1fr);gap:8px;padding:0 14px;"></div>
      <div style="padding:10px 14px 2px;font-size:12px;color:var(--tx2);">Tap any product image to tag it to this variant.</div>
    </div>

    <div style="padding:10px 14px calc(var(--sb)+10px);border-top:0.5px solid var(--br);background:var(--sf);">
      <button class="sh-done" onclick="closeSheet('sh-varimg')" style="margin:0;">Done</button>
    </div>
  </div>
</div>

<!-- SHEET: RESERVE -->
<div class="sh-ov" id="sh-reserve">
  <div style="flex:1;" onclick="closeSheet('sh-reserve')"></div>
  <div class="sh">
    <div class="sh-hdl"></div>
    <div class="sh-top">
      <span class="sh-main-title">Reserve stock</span>
      <span class="sh-close" onclick="closeSheet('sh-reserve')"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M18 6L6 18M6 6l12 12"/></svg></span>
    </div>
    <div style="padding:12px 16px 0;">
      <div class="lbl">Order / reference</div>
      <input class="inp" id="res-order" type="text" placeholder="e.g. ORD-1234 or Customer name" style="margin-top:4px;"/>
    </div>
    <div style="padding:10px 16px 0;">
      <div class="lbl">Customer</div>
      <input class="inp" id="res-customer" type="text" placeholder="Customer name" style="margin-top:4px;"/>
    </div>
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;padding:10px 16px 0;">
      <div>
        <div class="lbl">Qty to reserve</div>
        <input class="inp" id="res-qty" type="number" min="1" placeholder="0" style="margin-top:4px;"/>
      </div>
      <div>
        <div class="lbl">Status</div>
        <select class="inp" id="res-status" style="margin-top:4px;">
          <option value="confirmed">Confirmed</option>
          <option value="pending">Pending</option>
          <option value="partial">Partial</option>
        </select>
      </div>
    </div>
    <div style="padding:10px 16px 0;">
      <div class="lbl">Date</div>
      <input class="inp" id="res-date" type="date" style="margin-top:4px;"/>
    </div>
    <div style="padding:10px 16px 0;font-size:12px;color:var(--tx2);" id="res-avail-note"></div>
    <button class="sh-done" onclick="saveReservation()" style="margin-top:12px;">Reserve</button>
    <div style="height:8px;"></div>
  </div>
</div>

<!-- SHEET: BULK APPLY -->
<div class="sh-ov" id="sh-bulk">
  <div style="flex:1;" onclick="closeSheet('sh-bulk')"></div>
  <div class="sh">
    <div class="sh-hdl"></div>
    <div class="sh-top"><span class="sh-main-title">Apply to all variants</span><span class="sh-close" onclick="closeSheet('sh-bulk')"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M18 6L6 18M6 6l12 12"/></svg></span></div>
    <div class="sh-item" onclick="applyAll('pricing')"><div class="shi-ico" style="background:var(--pl);"><svg style="color:var(--p);" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82zM7 7h.01"/></svg></div><div class="shi-info"><div class="shi-title">Apply pricing</div><div class="shi-sub">Copy MRP, offer price and cost to all variants</div></div><svg style="color:var(--tx3);font-size:14px;" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 18l6-6-6-6"/></svg></div>
    <div class="sh-item" onclick="applyAll('images')"><div class="shi-ico" style="background:var(--gl);"><svg style="color:var(--gt);" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h3l2-2h4l2 2h3a2 2 0 0 1 2 2zM12 17a4 4 0 1 0 0-8 4 4 0 0 0 0 8z"/></svg></div><div class="shi-info"><div class="shi-title">Apply images</div><div class="shi-sub">Use same images for all variants</div></div><svg style="color:var(--tx3);font-size:14px;" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 18l6-6-6-6"/></svg></div>
    <div class="sh-item" onclick="applyAll('stock')"><div class="shi-ico" style="background:var(--al);"><svg style="color:var(--at);" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16zM3.27 6.96L12 12.01l8.73-5.05M12 22.08V12"/></svg></div><div class="shi-info"><div class="shi-title">Set opening stock for all</div><div class="shi-sub">Overwrite quantity for every variant</div></div><svg style="color:var(--tx3);font-size:14px;" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 18l6-6-6-6"/></svg></div>
    <div class="sh-item" onclick="applyAll('barcode')"><div class="shi-ico" style="background:var(--bl);"><svg style="color:var(--bt);" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 7v10M8 7v10M12 7v10M16 7v10M20 7v10M6 7v10M10 7v10M14 7v10M18 7v10"/></svg></div><div class="shi-info"><div class="shi-title">Auto-generate barcodes</div><div class="shi-sub">Generate barcodes for all variants from SKU</div></div><svg style="color:var(--tx3);font-size:14px;" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 18l6-6-6-6"/></svg></div>
    <div class="sh-item" onclick="applyAll('minqty')"><div class="shi-ico" style="background:var(--sf2);"><svg style="color:var(--tx2);" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0zM12 9v4M12 17h.01"/></svg></div><div class="shi-info"><div class="shi-title">Set min quantity for all</div><div class="shi-sub">Apply same reorder threshold to all variants</div></div><svg style="color:var(--tx3);font-size:14px;" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 18l6-6-6-6"/></svg></div>
  </div>
</div>

<!-- SHEET: SHOPIFY -->
<div class="sh-ov" id="sh-shopify">
  <div style="flex:1;" onclick="closeSheet('sh-shopify')"></div>
  <div class="sh">
    <div class="sh-hdl"></div>
    <div class="sh-top"><span class="sh-main-title">Import from Shopify</span><span class="sh-close" onclick="closeSheet('sh-shopify')"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M18 6L6 18M6 6l12 12"/></svg></span></div>
    <div style="padding:12px 16px;font-size:12px;color:var(--tx2);">Products, variants, images and SKUs are imported automatically.</div>
    <div class="sec" style="margin:0 12px;">
      <div style="padding:11px 14px;border-bottom:0.5px solid var(--br);"><div class="lbl">Store URL</div><input class="inp" id="shopify-url" type="text" placeholder="yourstore.myshopify.com"/></div>
      <div style="padding:11px 14px;"><div class="lbl">API access token</div><input class="inp" id="shopify-token" type="password" placeholder="shpat_xxxxxxxxxxxxxxxx"/></div>
    </div>
    <div id="shopify-prog" style="display:none;margin:10px 16px 0;">
      <div style="background:var(--sf2);border-radius:var(--rads);overflow:hidden;border:0.5px solid var(--br);">
        <div id="shopify-bar" style="height:4px;background:#96BF48;border-radius:4px;transition:width 0.4s;width:0%;"></div>
      </div>
      <div id="shopify-txt" style="padding:7px 0;font-size:12px;color:var(--tx2);">Connecting…</div>
    </div>
    <button class="sh-done" onclick="runShopifyImport()" style="background:#96BF48;">Start import</button>
  </div>
</div>

<script>
// ═══════════════════════════════
//  COLUMN VISIBILITY (declared early — renderList uses it)
// ═══════════════════════════════
var visibleCols={
  sku: true,
  vendor: true,
  varcount: true,
  qty: true,
  type_badge: true,
  collection_btn: true,
  value: false,
  avgcost: false,
};
// ═══════════════════════════════
//  DATA
// ═══════════════════════════════
var COLORS=['#4A3BB5','#BA7517','#185FA5','#993556','#639922','#854F0B','#1D9E75','#E24B4A','#7F77DD','#EF9F27'];
var STYLE_MAP={'Size':'size-s','Color':'color-s','Colour':'color-s','Material':'material-s','Pattern':'custom-s','Length':'custom-s','Fabric':'material-s'};

// ── OPTION SETS ──
var optionSets=[
  {id:'sys-size-1',cat:'Size',name:'Indian sizes',values:['XS','S','M','L','XL','XXL'],system:true},
  {id:'sys-size-2',cat:'Size',name:'Kids sizes',values:['2Y','4Y','6Y','8Y','10Y','12Y'],system:true},
  {id:'sys-size-3',cat:'Size',name:'Free size only',values:['Free size'],system:true},
  {id:'sys-size-4',cat:'Size',name:'Numeric (28–40)',values:['28','30','32','34','36','38','40'],system:true},
  {id:'sys-col-1',cat:'Color',name:'Festive palette',values:['Red','Maroon','Gold','Green','Navy','Magenta'],system:true},
  {id:'sys-col-2',cat:'Color',name:'Neutrals',values:['White','Ivory','Beige','Khaki','Grey','Black'],system:true},
  {id:'sys-col-3',cat:'Color',name:'Standard colours',values:['Red','Blue','Green','Yellow','Orange','Pink','Purple','White','Black'],system:true},
  {id:'sys-pat-1',cat:'Pattern',name:'Common prints',values:['Floral','Geometric','Abstract','Stripe','Polka dot','Paisley'],system:true},
  {id:'sys-mat-1',cat:'Material',name:'Common fabrics',values:['Cotton','Silk','Polyester','Linen','Chiffon','Rayon','Georgette'],system:true},
];
var STYLE_MAP_UNUSED=null;
var collections=[
  {id:'col-1',name:'Summer Festive 2025',desc:'Lightweight festive wear for summer season',color:'#E8703A',icon:'sun',
   manualIds:[1,3,5],tagRules:['festive','summer'],createdAt:'2025-03-10'},
  {id:'col-2',name:'Bridal Essentials',desc:'Premium sarees and lehengas for bridal occasions',color:'#B54A8F',icon:'star',
   manualIds:[2,8,12],tagRules:['bridal','wedding'],createdAt:'2025-01-20'},
  {id:'col-3',name:'Bestsellers',desc:'Top selling products this quarter',color:'#2D9E6B',icon:'trending',
   manualIds:[4,6,9,15],tagRules:['bestseller'],createdAt:'2025-02-05'},
];
var _colEditId=null;
var _colEditObj=null;
var _addToColMatId=null;
function catStyle(n){return STYLE_MAP[n]||'custom-s';}


/* ─── PHP DATA INJECTION ───────────────────────────────────────
   Replace the static arrays below with PHP/MySQL output:
   
   var materials = <?php echo json_encode($materials); ?>;
   var movements = <?php echo json_encode($movements); ?>;
   var collections = <?php echo json_encode($collections); ?>;
   
   API endpoints needed:
   POST /api/materials        - create/update
   GET  /api/materials        - list
   POST /api/movements        - record movement
   GET  /api/movements/{id}   - get for material
   POST /api/labels/print     - generate PDF
   ─────────────────────────────────────────────────────────── */
var materials=[
  {id:1,name:'Blue Offshoulder Chatri Aakaar',type:'finished',sku:'MTOCA-BLUE',vendors:[{name:'Sabrang Textiles',type:'primary',lead:'7 days',contact:'9831000111'}],imgs:[],desc:'A fun off-shoulder short dress.',notes:'',techpack:'',cats:[{name:'Size',style:'size-s',values:['S','M','L','XL']},{name:'Color',style:'color-s',values:['Blue','Grey']}],variants:[{name:'S/Blue',sku:'MTOCA-BLUE-S',mrp:6000,offer:5500,cost:2800,qty:12,barcode:'65895875',minqty:5,color:'#4A3BB5',tags:[],images:[],notes:'',costLines:[{label:'Fabric',val:1400},{label:'Labour',val:600},{label:'Dyeing',val:350},{label:'Accessories',val:120},{label:'Packaging',val:80},{label:'Overheads',val:250}],inventory:{stores:[{loc:'VB Asansol',qty:8,color:'#4A3BB5'},{loc:'VB Durgapur',qty:4,color:'#7F77DD'}],jobbers:[],production:[],warehouse:[]}},{name:'M/Blue',sku:'MTOCA-BLUE-M',mrp:6000,offer:5500,cost:2800,qty:0,barcode:'93698508',minqty:5,color:'#7F77DD',tags:[],images:[],notes:'',costLines:[{label:'Fabric',val:1400},{label:'Labour',val:600},{label:'Dyeing',val:350},{label:'Accessories',val:120},{label:'Packaging',val:80},{label:'Overheads',val:250}],inventory:{stores:[{loc:'VB Asansol',qty:0,color:'#4A3BB5'}],jobbers:[],production:[],warehouse:[]}},{name:'L/Blue',sku:'MTOCA-BLUE-L',mrp:6000,offer:5500,cost:2800,qty:5,barcode:'93698572',minqty:5,color:'#AFA9EC',tags:[],images:[],notes:'',costLines:[{label:'Fabric',val:1400},{label:'Labour',val:600},{label:'Dyeing',val:350},{label:'Accessories',val:120},{label:'Packaging',val:80},{label:'Overheads',val:250}],inventory:{stores:[{loc:'VB Asansol',qty:3,color:'#4A3BB5'},{loc:'VB Durgapur',qty:2,color:'#7F77DD'}],jobbers:[],production:[],warehouse:[]}}]},
  {id:2,name:'Khaki Boho Aakaar',type:'finished',sku:'MTBA-KHAKI',vendors:[{name:'Kolkata Weavers',type:'primary',lead:'10 days',contact:''}],imgs:[],desc:'',notes:'',techpack:'',cats:[{name:'Size',style:'size-s',values:['XS','S','M']}],variants:[{name:'XS',sku:'MTBA-KHAKI-XS',mrp:4800,offer:4200,cost:1800,qty:3,barcode:'',minqty:2,color:'#BA7517',tags:[],images:[],notes:'',costLines:[{label:'Fabric',val:900},{label:'Labour',val:500},{label:'Packaging',val:400}],inventory:{stores:[{loc:'VB Asansol',qty:3,color:'#BA7517'}],jobbers:[],production:[],warehouse:[]}},{name:'S',sku:'MTBA-KHAKI-S',mrp:4800,offer:4200,cost:1800,qty:8,barcode:'',minqty:2,color:'#EF9F27',tags:[],images:[],notes:'',costLines:[{label:'Fabric',val:900},{label:'Labour',val:500},{label:'Packaging',val:400}],inventory:{stores:[{loc:'VB Asansol',qty:8,color:'#EF9F27'}],jobbers:[],production:[],warehouse:[]}}]},
  {id:3,name:'Maroon Boho Aakaar',type:'raw',sku:'MTBA-MAROON',vendors:[],imgs:[],desc:'',notes:'',techpack:'',cats:[],variants:[{name:'Default',sku:'MTBA-MAROON',mrp:4800,offer:4200,cost:1800,qty:0,barcode:'',minqty:2,color:'#993556',tags:[],images:[],notes:'',costLines:[],inventory:{stores:[{loc:'VB Asansol',qty:0,color:'#993556'}],jobbers:[],production:[],warehouse:[]}}]},
  {id:4,name:'Mustard Umbrella Dress',type:'finished',sku:'MTUD-MUSTARD',vendors:[{name:'Dhaniakhali',type:'primary',lead:'12 days',contact:''}],imgs:[],desc:'',notes:'',techpack:'',cats:[{name:'Size',style:'size-s',values:['S','M','L']}],variants:[{name:'S',sku:'MTUD-S',mrp:5200,offer:4500,cost:2100,qty:6,barcode:'',minqty:3,color:'#EF9F27',tags:[],images:[],notes:'',costLines:[],inventory:{stores:[{loc:'VB Asansol',qty:6,color:'#EF9F27'}],jobbers:[],production:[],warehouse:[]}},{name:'M',sku:'MTUD-M',mrp:5200,offer:4500,cost:2100,qty:4,barcode:'',minqty:3,color:'#BA7517',tags:[],images:[],notes:'',costLines:[],inventory:{stores:[{loc:'VB Asansol',qty:4,color:'#BA7517'}],jobbers:[],production:[],warehouse:[]}},{name:'L',sku:'MTUD-L',mrp:5200,offer:4500,cost:2100,qty:0,barcode:'',minqty:3,color:'#854F0B',tags:[],images:[],notes:'',costLines:[],inventory:{stores:[{loc:'VB Asansol',qty:0,color:'#854F0B'}],jobbers:[],production:[],warehouse:[]}}]},
  {id:5,name:'Black Embroidered Kurti',type:'finished',sku:'MTEK-BLACK',vendors:[{name:'Sabrang Textiles',type:'primary',lead:'7 days',contact:''}],imgs:[],desc:'',notes:'',techpack:'',cats:[{name:'Size',style:'size-s',values:['S','M','L','XL','XXL']}],variants:[{name:'S',sku:'MTEK-S',mrp:3800,offer:3200,cost:1500,qty:10,barcode:'',minqty:3,color:'#1A1740',tags:[],images:[],notes:'',costLines:[],inventory:{stores:[{loc:'VB Asansol',qty:5,color:'#1A1740'},{loc:'VB Durgapur',qty:5,color:'#534AB7'}],jobbers:[],production:[],warehouse:[]}},{name:'M',sku:'MTEK-M',mrp:3800,offer:3200,cost:1500,qty:15,barcode:'',minqty:3,color:'#4A3BB5',tags:[],images:[],notes:'',costLines:[],inventory:{stores:[{loc:'VB Asansol',qty:15,color:'#4A3BB5'}],jobbers:[],production:[],warehouse:[]}},{name:'L',sku:'MTEK-L',mrp:3800,offer:3200,cost:1500,qty:8,barcode:'',minqty:3,color:'#7F77DD',tags:[],images:[],notes:'',costLines:[],inventory:{stores:[{loc:'VB Asansol',qty:8,color:'#7F77DD'}],jobbers:[],production:[],warehouse:[]}}]},
  {id:6,name:'Ivory Cotton Palazzo Set',type:'finished',sku:'MTICP-IVORY',vendors:[{name:'Kolkata Weavers',type:'primary',lead:'8 days',contact:''}],imgs:[],desc:'',notes:'',techpack:'',cats:[{name:'Size',style:'size-s',values:['S','M','L']}],variants:[{name:'S',sku:'MTICP-S',mrp:4200,offer:3600,cost:1700,qty:5,barcode:'',minqty:2,color:'#A09CC0',tags:[],images:[],notes:'',costLines:[],inventory:{stores:[{loc:'VB Asansol',qty:5,color:'#A09CC0'}],jobbers:[],production:[],warehouse:[]}},{name:'M',sku:'MTICP-M',mrp:4200,offer:3600,cost:1700,qty:0,barcode:'',minqty:2,color:'#6B6494',tags:[],images:[],notes:'',costLines:[],inventory:{stores:[{loc:'VB Asansol',qty:0,color:'#6B6494'}],jobbers:[],production:[],warehouse:[]}}]},
  {id:7,name:'Red Bandhani Saree',type:'finished',sku:'MTRBS-RED',vendors:[{name:'Dhaniakhali',type:'primary',lead:'14 days',contact:''}],imgs:[],desc:'',notes:'',techpack:'',cats:[],variants:[{name:'Default',sku:'MTRBS-RED',mrp:8500,offer:7200,cost:3800,qty:4,barcode:'',minqty:1,color:'#E24B4A',tags:[],images:[],notes:'',costLines:[],inventory:{stores:[{loc:'VB Asansol',qty:4,color:'#E24B4A'}],jobbers:[],production:[],warehouse:[]}}]},
  {id:8,name:'Green Chanderi Suit',type:'finished',sku:'MTGCS-GREEN',vendors:[{name:'Sabrang Textiles',type:'primary',lead:'7 days',contact:''}],imgs:[],desc:'',notes:'',techpack:'',cats:[{name:'Size',style:'size-s',values:['S','M','L','XL']}],variants:[{name:'S',sku:'MTGCS-S',mrp:6800,offer:5800,cost:2900,qty:3,barcode:'',minqty:2,color:'#1D9E75',tags:[],images:[],notes:'',costLines:[],inventory:{stores:[{loc:'VB Asansol',qty:3,color:'#1D9E75'}],jobbers:[],production:[],warehouse:[]}},{name:'M',sku:'MTGCS-M',mrp:6800,offer:5800,cost:2900,qty:7,barcode:'',minqty:2,color:'#639922',tags:[],images:[],notes:'',costLines:[],inventory:{stores:[{loc:'VB Asansol',qty:7,color:'#639922'}],jobbers:[],production:[],warehouse:[]}},{name:'L',sku:'MTGCS-L',mrp:6800,offer:5800,cost:2900,qty:2,barcode:'',minqty:2,color:'#3B6D11',tags:[],images:[],notes:'',costLines:[],inventory:{stores:[{loc:'VB Asansol',qty:2,color:'#3B6D11'}],jobbers:[],production:[],warehouse:[]}}]},
  {id:9,name:'Navy Anarkali Kurta',type:'finished',sku:'MTNAK-NAVY',vendors:[{name:'Kolkata Weavers',type:'primary',lead:'10 days',contact:''}],imgs:[],desc:'',notes:'',techpack:'',cats:[{name:'Size',style:'size-s',values:['XS','S','M','L']}],variants:[{name:'XS',sku:'MTNAK-XS',mrp:4500,offer:3900,cost:1900,qty:2,barcode:'',minqty:2,color:'#0C447C',tags:[],images:[],notes:'',costLines:[],inventory:{stores:[{loc:'VB Asansol',qty:2,color:'#0C447C'}],jobbers:[],production:[],warehouse:[]}},{name:'S',sku:'MTNAK-S',mrp:4500,offer:3900,cost:1900,qty:6,barcode:'',minqty:2,color:'#185FA5',tags:[],images:[],notes:'',costLines:[],inventory:{stores:[{loc:'VB Asansol',qty:6,color:'#185FA5'}],jobbers:[],production:[],warehouse:[]}},{name:'M',sku:'MTNAK-M',mrp:4500,offer:3900,cost:1900,qty:0,barcode:'',minqty:2,color:'#1D6DC5',tags:[],images:[],notes:'',costLines:[],inventory:{stores:[{loc:'VB Asansol',qty:0,color:'#1D6DC5'}],jobbers:[],production:[],warehouse:[]}}]},
  {id:10,name:'Peach Georgette Dupatta',type:'finished',sku:'MTPGD-PEACH',vendors:[{name:'Dhaniakhali',type:'primary',lead:'5 days',contact:''}],imgs:[],desc:'',notes:'',techpack:'',cats:[],variants:[{name:'Default',sku:'MTPGD',mrp:1200,offer:950,cost:380,qty:22,barcode:'',minqty:5,color:'#EF9F27',tags:[],images:[],notes:'',costLines:[],inventory:{stores:[{loc:'VB Asansol',qty:12,color:'#EF9F27'},{loc:'VB Durgapur',qty:10,color:'#BA7517'}],jobbers:[],production:[],warehouse:[]}}]},
  {id:11,name:'White Lucknowi Chikan Kurti',type:'finished',sku:'MTWLCK-WHITE',vendors:[{name:'Sabrang Textiles',type:'primary',lead:'12 days',contact:''}],imgs:[],desc:'',notes:'',techpack:'',cats:[{name:'Size',style:'size-s',values:['S','M','L','XL']}],variants:[{name:'S',sku:'MTWLCK-S',mrp:3500,offer:2900,cost:1300,qty:8,barcode:'',minqty:3,color:'#A09CC0',tags:[],images:[],notes:'',costLines:[],inventory:{stores:[{loc:'VB Asansol',qty:8,color:'#A09CC0'}],jobbers:[],production:[],warehouse:[]}},{name:'M',sku:'MTWLCK-M',mrp:3500,offer:2900,cost:1300,qty:12,barcode:'',minqty:3,color:'#6B6494',tags:[],images:[],notes:'',costLines:[],inventory:{stores:[{loc:'VB Asansol',qty:12,color:'#6B6494'}],jobbers:[],production:[],warehouse:[]}}]},
  {id:12,name:'Grey Cotton Fabric Roll',type:'raw',sku:'RMAT-GREY-CTN',vendors:[{name:'Kolkata Weavers',type:'primary',lead:'3 days',contact:''}],imgs:[],desc:'',notes:'',techpack:'',cats:[],variants:[{name:'Per metre',sku:'RMAT-GREY-CTN',mrp:85,offer:75,cost:45,qty:200,barcode:'',minqty:50,color:'#6B6494',tags:[],images:[],notes:'',costLines:[],inventory:{stores:[],jobbers:[],production:[{loc:'Factory floor',qty:200,color:'#639922'}],warehouse:[]}}]},
  {id:13,name:'Silk Thread Bundle',type:'raw',sku:'RMAT-SILK-THR',vendors:[{name:'Dhaniakhali',type:'primary',lead:'2 days',contact:''}],imgs:[],desc:'',notes:'',techpack:'',cats:[{name:'Color',style:'color-s',values:['Red','Blue','Gold']}],variants:[{name:'Red',sku:'RMAT-SILK-RED',mrp:120,offer:100,cost:55,qty:40,barcode:'',minqty:10,color:'#E24B4A',tags:[],images:[],notes:'',costLines:[],inventory:{stores:[],jobbers:[],production:[{loc:'Factory floor',qty:40,color:'#E24B4A'}],warehouse:[]}},{name:'Blue',sku:'RMAT-SILK-BLUE',mrp:120,offer:100,cost:55,qty:35,barcode:'',minqty:10,color:'#185FA5',tags:[],images:[],notes:'',costLines:[],inventory:{stores:[],jobbers:[],production:[{loc:'Factory floor',qty:35,color:'#185FA5'}],warehouse:[]}}]},
  {id:14,name:'Magenta Floral Print Kurti',type:'finished',sku:'MTMFK-MAG',vendors:[{name:'Sabrang Textiles',type:'primary',lead:'7 days',contact:''}],imgs:[],desc:'',notes:'',techpack:'',cats:[{name:'Size',style:'size-s',values:['S','M','L']}],variants:[{name:'S',sku:'MTMFK-S',mrp:2800,offer:2400,cost:1100,qty:9,barcode:'',minqty:3,color:'#993556',tags:[],images:[],notes:'',costLines:[],inventory:{stores:[{loc:'VB Asansol',qty:9,color:'#993556'}],jobbers:[],production:[],warehouse:[]}},{name:'M',sku:'MTMFK-M',mrp:2800,offer:2400,cost:1100,qty:5,barcode:'',minqty:3,color:'#C23070',tags:[],images:[],notes:'',costLines:[],inventory:{stores:[{loc:'VB Asansol',qty:5,color:'#C23070'}],jobbers:[],production:[],warehouse:[]}}]},
  {id:15,name:'Teal Ajrakh Block Print Shirt',type:'finished',sku:'MTABS-TEAL',vendors:[{name:'Dhaniakhali',type:'primary',lead:'15 days',contact:''}],imgs:[],desc:'',notes:'',techpack:'',cats:[{name:'Size',style:'size-s',values:['S','M','L','XL']}],variants:[{name:'S',sku:'MTABS-S',mrp:3200,offer:2750,cost:1250,qty:4,barcode:'',minqty:2,color:'#1D9E75',tags:[],images:[],notes:'',costLines:[],inventory:{stores:[{loc:'VB Asansol',qty:4,color:'#1D9E75'}],jobbers:[],production:[],warehouse:[]}},{name:'M',sku:'MTABS-M',mrp:3200,offer:2750,cost:1250,qty:6,barcode:'',minqty:2,color:'#15876A',tags:[],images:[],notes:'',costLines:[],inventory:{stores:[{loc:'VB Asansol',qty:6,color:'#15876A'}],jobbers:[],production:[],warehouse:[]}}]},
  {id:16,name:'Orange Ikat Saree',type:'finished',sku:'MTOIS-ORANGE',vendors:[{name:'Kolkata Weavers',type:'primary',lead:'10 days',contact:''}],imgs:[],desc:'',notes:'',techpack:'',cats:[],variants:[{name:'Default',sku:'MTOIS-ORANGE',mrp:7500,offer:6400,cost:3200,qty:3,barcode:'',minqty:1,color:'#E24B4A',tags:[],images:[],notes:'',costLines:[],inventory:{stores:[{loc:'VB Asansol',qty:3,color:'#E24B4A'}],jobbers:[],production:[],warehouse:[]}}]},
  {id:17,name:'Beige Handloom Cotton Saree',type:'finished',sku:'MTBHCS-BEIGE',vendors:[{name:'Dhaniakhali',type:'primary',lead:'14 days',contact:''}],imgs:[],desc:'',notes:'',techpack:'',cats:[],variants:[{name:'Default',sku:'MTBHCS-BEIGE',mrp:5500,offer:4800,cost:2400,qty:7,barcode:'',minqty:2,color:'#BA7517',tags:[],images:[],notes:'',costLines:[],inventory:{stores:[{loc:'VB Asansol',qty:7,color:'#BA7517'}],jobbers:[],production:[],warehouse:[]}}]},
  {id:18,name:'Pink Palazzo Pants',type:'finished',sku:'MTPP-PINK',vendors:[{name:'Sabrang Textiles',type:'primary',lead:'6 days',contact:''}],imgs:[],desc:'',notes:'',techpack:'',cats:[{name:'Size',style:'size-s',values:['S','M','L','XL']}],variants:[{name:'S',sku:'MTPP-S',mrp:2200,offer:1850,cost:850,qty:11,barcode:'',minqty:3,color:'#C23070',tags:[],images:[],notes:'',costLines:[],inventory:{stores:[{loc:'VB Asansol',qty:6,color:'#C23070'},{loc:'VB Durgapur',qty:5,color:'#993556'}],jobbers:[],production:[],warehouse:[]}},{name:'M',sku:'MTPP-M',mrp:2200,offer:1850,cost:850,qty:9,barcode:'',minqty:3,color:'#993556',tags:[],images:[],notes:'',costLines:[],inventory:{stores:[{loc:'VB Asansol',qty:9,color:'#993556'}],jobbers:[],production:[],warehouse:[]}}]},
  {id:19,name:'Brown Kalamkari Dupatta',type:'finished',sku:'MTBKD-BROWN',vendors:[{name:'Dhaniakhali',type:'primary',lead:'5 days',contact:''}],imgs:[],desc:'',notes:'',techpack:'',cats:[],variants:[{name:'Default',sku:'MTBKD-BROWN',mrp:1400,offer:1150,cost:480,qty:16,barcode:'',minqty:4,color:'#854F0B',tags:[],images:[],notes:'',costLines:[],inventory:{stores:[{loc:'VB Asansol',qty:16,color:'#854F0B'}],jobbers:[],production:[],warehouse:[]}}]},
  {id:20,name:'Purple Embroidered Lehenga',type:'finished',sku:'MTPEL-PURPLE',vendors:[{name:'Kolkata Weavers',type:'primary',lead:'18 days',contact:''}],imgs:[],desc:'',notes:'',techpack:'',cats:[{name:'Size',style:'size-s',values:['S','M','L']}],variants:[{name:'S',sku:'MTPEL-S',mrp:12000,offer:9800,cost:5200,qty:1,barcode:'',minqty:1,color:'#4A3BB5',tags:[],images:[],notes:'',costLines:[],inventory:{stores:[{loc:'VB Asansol',qty:1,color:'#4A3BB5'}],jobbers:[],production:[],warehouse:[]}},{name:'M',sku:'MTPEL-M',mrp:12000,offer:9800,cost:5200,qty:2,barcode:'',minqty:1,color:'#534AB7',tags:[],images:[],notes:'',costLines:[],inventory:{stores:[{loc:'VB Asansol',qty:2,color:'#534AB7'}],jobbers:[],production:[],warehouse:[]}}]},
  {id:21,name:'Yellow Chiffon Top',type:'finished',sku:'MTYCT-YELLOW',vendors:[{name:'Sabrang Textiles',type:'primary',lead:'7 days',contact:''}],imgs:[],desc:'',notes:'',techpack:'',cats:[{name:'Size',style:'size-s',values:['XS','S','M','L']}],variants:[{name:'XS',sku:'MTYCT-XS',mrp:1800,offer:1500,cost:680,qty:7,barcode:'',minqty:3,color:'#EF9F27',tags:[],images:[],notes:'',costLines:[],inventory:{stores:[{loc:'VB Asansol',qty:7,color:'#EF9F27'}],jobbers:[],production:[],warehouse:[]}},{name:'S',sku:'MTYCT-S',mrp:1800,offer:1500,cost:680,qty:12,barcode:'',minqty:3,color:'#BA7517',tags:[],images:[],notes:'',costLines:[],inventory:{stores:[{loc:'VB Asansol',qty:12,color:'#BA7517'}],jobbers:[],production:[],warehouse:[]}}]},
  {id:22,name:'Cotton Lining Fabric',type:'raw',sku:'RMAT-LINING',vendors:[{name:'Kolkata Weavers',type:'primary',lead:'3 days',contact:''}],imgs:[],desc:'',notes:'',techpack:'',cats:[],variants:[{name:'Per metre',sku:'RMAT-LINING',mrp:55,offer:48,cost:28,qty:350,barcode:'',minqty:100,color:'#A09CC0',tags:[],images:[],notes:'',costLines:[],inventory:{stores:[],jobbers:[],production:[{loc:'Factory floor',qty:350,color:'#639922'}],warehouse:[]}}]},
  {id:23,name:'Gold Zari Thread',type:'raw',sku:'RMAT-ZARI-GOLD',vendors:[{name:'Dhaniakhali',type:'primary',lead:'4 days',contact:''}],imgs:[],desc:'',notes:'',techpack:'',cats:[],variants:[{name:'Per roll',sku:'RMAT-ZARI-GOLD',mrp:280,offer:240,cost:140,qty:60,barcode:'',minqty:15,color:'#BA7517',tags:[],images:[],notes:'',costLines:[],inventory:{stores:[],jobbers:[],production:[{loc:'Factory floor',qty:60,color:'#BA7517'}],warehouse:[]}}]},
  {id:24,name:'Rust Printed Maxi Dress',type:'finished',sku:'MTRPMD-RUST',vendors:[{name:'Sabrang Textiles',type:'primary',lead:'7 days',contact:''}],imgs:[],desc:'',notes:'',techpack:'',cats:[{name:'Size',style:'size-s',values:['S','M','L','XL']}],variants:[{name:'S',sku:'MTRPMD-S',mrp:4600,offer:3900,cost:1850,qty:5,barcode:'',minqty:2,color:'#E24B4A',tags:[],images:[],notes:'',costLines:[],inventory:{stores:[{loc:'VB Asansol',qty:5,color:'#E24B4A'}],jobbers:[],production:[],warehouse:[]}},{name:'M',sku:'MTRPMD-M',mrp:4600,offer:3900,cost:1850,qty:3,barcode:'',minqty:2,color:'#A32D2D',tags:[],images:[],notes:'',costLines:[],inventory:{stores:[{loc:'VB Asansol',qty:3,color:'#A32D2D'}],jobbers:[],production:[],warehouse:[]}}]},
  {id:25,name:'Sky Blue Rayon Fabric',type:'raw',sku:'RMAT-RAYON-SKY',vendors:[{name:'Kolkata Weavers',type:'primary',lead:'3 days',contact:''}],imgs:[],desc:'',notes:'',techpack:'',cats:[],variants:[{name:'Per metre',sku:'RMAT-RAYON-SKY',mrp:95,offer:82,cost:50,qty:180,barcode:'',minqty:50,color:'#85B7EB',tags:[],images:[],notes:'',costLines:[],inventory:{stores:[],jobbers:[],production:[{loc:'Factory floor',qty:180,color:'#85B7EB'}],warehouse:[]}}]},
  {id:26,name:'Coral Short Kurta',type:'finished',sku:'MTCSK-CORAL',vendors:[{name:'Sabrang Textiles',type:'primary',lead:'7 days',contact:''}],imgs:[],desc:'',notes:'',techpack:'',cats:[{name:'Size',style:'size-s',values:['S','M','L']}],variants:[{name:'S',sku:'MTCSK-S',mrp:2600,offer:2200,cost:980,qty:8,barcode:'',minqty:3,color:'#E24B4A',tags:[],images:[],notes:'',costLines:[],inventory:{stores:[{loc:'VB Asansol',qty:8,color:'#E24B4A'}],jobbers:[],production:[],warehouse:[]}},{name:'M',sku:'MTCSK-M',mrp:2600,offer:2200,cost:980,qty:6,barcode:'',minqty:3,color:'#C23070',tags:[],images:[],notes:'',costLines:[],inventory:{stores:[{loc:'VB Asansol',qty:6,color:'#C23070'}],jobbers:[],production:[],warehouse:[]}}]},
  {id:27,name:'Indigo Hand-dyed Stole',type:'finished',sku:'MTIHS-INDIGO',vendors:[{name:'Dhaniakhali',type:'primary',lead:'6 days',contact:''}],imgs:[],desc:'',notes:'',techpack:'',cats:[],variants:[{name:'Default',sku:'MTIHS-INDIGO',mrp:1600,offer:1350,cost:580,qty:20,barcode:'',minqty:5,color:'#0C447C',tags:[],images:[],notes:'',costLines:[],inventory:{stores:[{loc:'VB Asansol',qty:12,color:'#0C447C'},{loc:'VB Durgapur',qty:8,color:'#185FA5'}],jobbers:[],production:[],warehouse:[]}}]},
  {id:28,name:'Off-white Silk Blouse',type:'finished',sku:'MTOSB-OFFWHT',vendors:[{name:'Kolkata Weavers',type:'primary',lead:'8 days',contact:''}],imgs:[],desc:'',notes:'',techpack:'',cats:[{name:'Size',style:'size-s',values:['32','34','36','38','40']}],variants:[{name:'32',sku:'MTOSB-32',mrp:2200,offer:1850,cost:850,qty:4,barcode:'',minqty:2,color:'#A09CC0',tags:[],images:[],notes:'',costLines:[],inventory:{stores:[{loc:'VB Asansol',qty:4,color:'#A09CC0'}],jobbers:[],production:[],warehouse:[]}},{name:'34',sku:'MTOSB-34',mrp:2200,offer:1850,cost:850,qty:7,barcode:'',minqty:2,color:'#6B6494',tags:[],images:[],notes:'',costLines:[],inventory:{stores:[{loc:'VB Asansol',qty:7,color:'#6B6494'}],jobbers:[],production:[],warehouse:[]}},{name:'36',sku:'MTOSB-36',mrp:2200,offer:1850,cost:850,qty:5,barcode:'',minqty:2,color:'#4A3BB5',tags:[],images:[],notes:'',costLines:[],inventory:{stores:[{loc:'VB Asansol',qty:5,color:'#4A3BB5'}],jobbers:[],production:[],warehouse:[]}}]},
  {id:29,name:'Lemon Yellow Sharara',type:'finished',sku:'MTLYS-LEMON',vendors:[{name:'Sabrang Textiles',type:'primary',lead:'9 days',contact:''}],imgs:[],desc:'',notes:'',techpack:'',cats:[{name:'Size',style:'size-s',values:['S','M','L']}],variants:[{name:'S',sku:'MTLYS-S',mrp:5800,offer:4900,cost:2300,qty:3,barcode:'',minqty:2,color:'#EF9F27',tags:[],images:[],notes:'',costLines:[],inventory:{stores:[{loc:'VB Asansol',qty:3,color:'#EF9F27'}],jobbers:[],production:[],warehouse:[]}},{name:'M',sku:'MTLYS-M',mrp:5800,offer:4900,cost:2300,qty:0,barcode:'',minqty:2,color:'#BA7517',tags:[],images:[],notes:'',costLines:[],inventory:{stores:[{loc:'VB Asansol',qty:0,color:'#BA7517'}],jobbers:[],production:[],warehouse:[]}}]},
  {id:30,name:'Dark Green Velvet Blouse',type:'finished',sku:'MTDGVB-GREEN',vendors:[{name:'Kolkata Weavers',type:'primary',lead:'10 days',contact:''}],imgs:[],desc:'',notes:'',techpack:'',cats:[{name:'Size',style:'size-s',values:['32','34','36','38']}],variants:[{name:'32',sku:'MTDGVB-32',mrp:3400,offer:2900,cost:1350,qty:4,barcode:'',minqty:2,color:'#3B6D11',tags:[],images:[],notes:'',costLines:[],inventory:{stores:[{loc:'VB Asansol',qty:4,color:'#3B6D11'}],jobbers:[],production:[],warehouse:[]}},{name:'34',sku:'MTDGVB-34',mrp:3400,offer:2900,cost:1350,qty:6,barcode:'',minqty:2,color:'#639922',tags:[],images:[],notes:'',costLines:[],inventory:{stores:[{loc:'VB Asansol',qty:6,color:'#639922'}],jobbers:[],production:[],warehouse:[]}}]},
  {id:31,name:'Wine Red Crepe Saree',type:'finished',sku:'MTWRCS-WINE',vendors:[{name:'Dhaniakhali',type:'primary',lead:'12 days',contact:''}],imgs:[],desc:'',notes:'',techpack:'',cats:[],variants:[{name:'Default',sku:'MTWRCS-WINE',mrp:6200,offer:5400,cost:2700,qty:5,barcode:'',minqty:1,color:'#993556',tags:[],images:[],notes:'',costLines:[],inventory:{stores:[{loc:'VB Asansol',qty:5,color:'#993556'}],jobbers:[],production:[],warehouse:[]}}]},
  {id:32,name:'Printed Chiffon Saree',type:'finished',sku:'MTPCS-PRINT',vendors:[{name:'Sabrang Textiles',type:'primary',lead:'7 days',contact:''}],imgs:[],desc:'',notes:'',techpack:'',cats:[{name:'Color',style:'color-s',values:['Blue','Pink','Green']}],variants:[{name:'Blue',sku:'MTPCS-BLUE',mrp:3200,offer:2700,cost:1250,qty:8,barcode:'',minqty:2,color:'#185FA5',tags:[],images:[],notes:'',costLines:[],inventory:{stores:[{loc:'VB Asansol',qty:8,color:'#185FA5'}],jobbers:[],production:[],warehouse:[]}},{name:'Pink',sku:'MTPCS-PINK',mrp:3200,offer:2700,cost:1250,qty:6,barcode:'',minqty:2,color:'#C23070',tags:[],images:[],notes:'',costLines:[],inventory:{stores:[{loc:'VB Asansol',qty:6,color:'#C23070'}],jobbers:[],production:[],warehouse:[]}},{name:'Green',sku:'MTPCS-GREEN',mrp:3200,offer:2700,cost:1250,qty:4,barcode:'',minqty:2,color:'#639922',tags:[],images:[],notes:'',costLines:[],inventory:{stores:[{loc:'VB Asansol',qty:4,color:'#639922'}],jobbers:[],production:[],warehouse:[]}}]},
  {id:33,name:'Aari Work Jacket',type:'production',sku:'MTAWJ-PROD',vendors:[{name:'Sabrang Textiles',type:'primary',lead:'21 days',contact:''}],imgs:[],desc:'',notes:'',techpack:'',cats:[{name:'Size',style:'size-s',values:['S','M','L']}],variants:[{name:'S',sku:'MTAWJ-S',mrp:8500,offer:7200,cost:3800,qty:2,barcode:'',minqty:1,color:'#4A3BB5',tags:[],images:[],notes:'',costLines:[],inventory:{stores:[{loc:'VB Asansol',qty:2,color:'#4A3BB5'}],jobbers:[],production:[{loc:'Factory floor',qty:5,color:'#639922'}],warehouse:[]}},{name:'M',sku:'MTAWJ-M',mrp:8500,offer:7200,cost:3800,qty:0,barcode:'',minqty:1,color:'#534AB7',tags:[],images:[],notes:'',costLines:[],inventory:{stores:[],jobbers:[],production:[{loc:'Factory floor',qty:8,color:'#639922'}],warehouse:[]}}]},
  {id:34,name:'Terracotta Mirror Work Kurti',type:'finished',sku:'MTTMK-TERRA',vendors:[{name:'Dhaniakhali',type:'primary',lead:'14 days',contact:''}],imgs:[],desc:'',notes:'',techpack:'',cats:[{name:'Size',style:'size-s',values:['S','M','L','XL']}],variants:[{name:'S',sku:'MTTMK-S',mrp:4200,offer:3600,cost:1700,qty:5,barcode:'',minqty:2,color:'#E24B4A',tags:[],images:[],notes:'',costLines:[],inventory:{stores:[{loc:'VB Asansol',qty:5,color:'#E24B4A'}],jobbers:[],production:[],warehouse:[]}},{name:'M',sku:'MTTMK-M',mrp:4200,offer:3600,cost:1700,qty:8,barcode:'',minqty:2,color:'#A32D2D',tags:[],images:[],notes:'',costLines:[],inventory:{stores:[{loc:'VB Asansol',qty:8,color:'#A32D2D'}],jobbers:[],production:[],warehouse:[]}}]},
  {id:35,name:'Sage Green Linen Kurta',type:'finished',sku:'MTSGLK-SAGE',vendors:[{name:'Kolkata Weavers',type:'primary',lead:'8 days',contact:''}],imgs:[],desc:'',notes:'',techpack:'',cats:[{name:'Size',style:'size-s',values:['S','M','L','XL','XXL']}],variants:[{name:'S',sku:'MTSGLK-S',mrp:3100,offer:2650,cost:1200,qty:10,barcode:'',minqty:3,color:'#1D9E75',tags:[],images:[],notes:'',costLines:[],inventory:{stores:[{loc:'VB Asansol',qty:10,color:'#1D9E75'}],jobbers:[],production:[],warehouse:[]}},{name:'M',sku:'MTSGLK-M',mrp:3100,offer:2650,cost:1200,qty:14,barcode:'',minqty:3,color:'#15876A',tags:[],images:[],notes:'',costLines:[],inventory:{stores:[{loc:'VB Asansol',qty:14,color:'#15876A'}],jobbers:[],production:[],warehouse:[]}},{name:'L',sku:'MTSGLK-L',mrp:3100,offer:2650,cost:1200,qty:7,barcode:'',minqty:3,color:'#639922',tags:[],images:[],notes:'',costLines:[],inventory:{stores:[{loc:'VB Asansol',qty:7,color:'#639922'}],jobbers:[],production:[],warehouse:[]}}]},
  {id:36,name:'Embroidery Floss Set',type:'raw',sku:'RMAT-EMBR',vendors:[{name:'Dhaniakhali',type:'primary',lead:'2 days',contact:''}],imgs:[],desc:'',notes:'',techpack:'',cats:[],variants:[{name:'Assorted',sku:'RMAT-EMBR',mrp:380,offer:320,cost:180,qty:80,barcode:'',minqty:20,color:'#EF9F27',tags:[],images:[],notes:'',costLines:[],inventory:{stores:[],jobbers:[],production:[{loc:'Factory floor',qty:80,color:'#EF9F27'}],warehouse:[]}}]},
  {id:37,name:'Crimson Banarasi Saree',type:'finished',sku:'MTCBS-CRIM',vendors:[{name:'Kolkata Weavers',type:'primary',lead:'21 days',contact:''}],imgs:[],desc:'',notes:'',techpack:'',cats:[],variants:[{name:'Default',sku:'MTCBS-CRIM',mrp:18000,offer:15500,cost:8200,qty:2,barcode:'',minqty:1,color:'#A32D2D',tags:[],images:[],notes:'',costLines:[],inventory:{stores:[{loc:'VB Asansol',qty:2,color:'#A32D2D'}],jobbers:[],production:[],warehouse:[]}}]},
  {id:38,name:'Pastel Set of 3 Kurtis',type:'finished',sku:'MTPS3K-PASTEL',vendors:[{name:'Sabrang Textiles',type:'primary',lead:'10 days',contact:''}],imgs:[],desc:'',notes:'',techpack:'',cats:[{name:'Size',style:'size-s',values:['S','M','L']}],variants:[{name:'S',sku:'MTPS3K-S',mrp:4500,offer:3800,cost:1800,qty:6,barcode:'',minqty:2,color:'#A09CC0',tags:[],images:[],notes:'',costLines:[],inventory:{stores:[{loc:'VB Asansol',qty:6,color:'#A09CC0'}],jobbers:[],production:[],warehouse:[]}},{name:'M',sku:'MTPS3K-M',mrp:4500,offer:3800,cost:1800,qty:4,barcode:'',minqty:2,color:'#7F77DD',tags:[],images:[],notes:'',costLines:[],inventory:{stores:[{loc:'VB Asansol',qty:4,color:'#7F77DD'}],jobbers:[],production:[],warehouse:[]}}]},
  {id:39,name:'Mauve Kaftan Top',type:'finished',sku:'MTMKT-MAUVE',vendors:[{name:'Dhaniakhali',type:'primary',lead:'7 days',contact:''}],imgs:[],desc:'',notes:'',techpack:'',cats:[{name:'Size',style:'size-s',values:['Free size']}],variants:[{name:'Free size',sku:'MTMKT-FS',mrp:2100,offer:1750,cost:790,qty:18,barcode:'',minqty:5,color:'#993556',tags:[],images:[],notes:'',costLines:[],inventory:{stores:[{loc:'VB Asansol',qty:10,color:'#993556'},{loc:'VB Durgapur',qty:8,color:'#C23070'}],jobbers:[],production:[],warehouse:[]}}]},
  {id:40,name:'Sequin Border Dupatta',type:'finished',sku:'MTSBD-SEQ',vendors:[{name:'Kolkata Weavers',type:'primary',lead:'5 days',contact:''}],imgs:[],desc:'',notes:'',techpack:'',cats:[{name:'Color',style:'color-s',values:['Gold','Silver','Rose']}],variants:[{name:'Gold',sku:'MTSBD-GOLD',mrp:1900,offer:1600,cost:720,qty:12,barcode:'',minqty:3,color:'#BA7517',tags:[],images:[],notes:'',costLines:[],inventory:{stores:[{loc:'VB Asansol',qty:12,color:'#BA7517'}],jobbers:[],production:[],warehouse:[]}},{name:'Silver',sku:'MTSBD-SIL',mrp:1900,offer:1600,cost:720,qty:9,barcode:'',minqty:3,color:'#6B6494',tags:[],images:[],notes:'',costLines:[],inventory:{stores:[{loc:'VB Asansol',qty:9,color:'#6B6494'}],jobbers:[],production:[],warehouse:[]}}]},
  {id:41,name:'Handblock Cotton Stole',type:'finished',sku:'MTHCS-BLOCK',vendors:[{name:'Dhaniakhali',type:'primary',lead:'4 days',contact:''}],imgs:[],desc:'',notes:'',techpack:'',cats:[{name:'Color',style:'color-s',values:['Indigo','Maroon','Olive']}],variants:[{name:'Indigo',sku:'MTHCS-IND',mrp:1100,offer:880,cost:380,qty:25,barcode:'',minqty:5,color:'#0C447C',tags:[],images:[],notes:'',costLines:[],inventory:{stores:[{loc:'VB Asansol',qty:15,color:'#0C447C'},{loc:'VB Durgapur',qty:10,color:'#185FA5'}],jobbers:[],production:[],warehouse:[]}},{name:'Maroon',sku:'MTHCS-MAR',mrp:1100,offer:880,cost:380,qty:18,barcode:'',minqty:5,color:'#993556',tags:[],images:[],notes:'',costLines:[],inventory:{stores:[{loc:'VB Asansol',qty:18,color:'#993556'}],jobbers:[],production:[],warehouse:[]}}]},
  {id:42,name:'Fuschia Georgette Kurti',type:'finished',sku:'MTFGK-FUSE',vendors:[{name:'Sabrang Textiles',type:'primary',lead:'7 days',contact:''}],imgs:[],desc:'',notes:'',techpack:'',cats:[{name:'Size',style:'size-s',values:['S','M','L','XL']}],variants:[{name:'S',sku:'MTFGK-S',mrp:2900,offer:2450,cost:1100,qty:7,barcode:'',minqty:3,color:'#C23070',tags:[],images:[],notes:'',costLines:[],inventory:{stores:[{loc:'VB Asansol',qty:7,color:'#C23070'}],jobbers:[],production:[],warehouse:[]}},{name:'M',sku:'MTFGK-M',mrp:2900,offer:2450,cost:1100,qty:11,barcode:'',minqty:3,color:'#993556',tags:[],images:[],notes:'',costLines:[],inventory:{stores:[{loc:'VB Asansol',qty:11,color:'#993556'}],jobbers:[],production:[],warehouse:[]}}]},
  {id:43,name:'Dark Wash Denim Fabric',type:'raw',sku:'RMAT-DENIM',vendors:[{name:'Kolkata Weavers',type:'primary',lead:'5 days',contact:''}],imgs:[],desc:'',notes:'',techpack:'',cats:[],variants:[{name:'Per metre',sku:'RMAT-DENIM',mrp:220,offer:190,cost:110,qty:90,barcode:'',minqty:30,color:'#0C447C',tags:[],images:[],notes:'',costLines:[],inventory:{stores:[],jobbers:[],production:[{loc:'Factory floor',qty:90,color:'#0C447C'}],warehouse:[]}}]},
];

var expandedIds={};
var visibleCols={
  sku: true,
  vendor: true,
  varcount: true,
  qty: true,
  type_badge: true,
  collection_btn: true,
  value: false,
  avgcost: false,
};
var curPage=1;
var PAGE_SIZE=15;
var activeF={qmode:'',qval:null,qmin:null,qmax:null,types:[],vendors:[],varcount:'',flags:[],sort:'name'};
// ─ CUSTOM TABS ─
var DEFAULT_CTABS=[
  {id:'ct-low',name:'Low Stock',color:'#E24B4A',filters:{stockStatus:'low'}},
  {id:'ct-out',name:'Out of Stock',color:'#A32D2D',filters:{stockStatus:'out'}},
  {id:'ct-active',name:'Active Fabrics',color:'#1D9E75',filters:{tag:'fabric'}},
  {id:'ct-pend',name:'Pending Reorder',color:'#BA7517',filters:{tag:'reorder'}}
];
var customTabs=JSON.parse(localStorage.getItem('boutiq_ctabs')||'null')||DEFAULT_CTABS.slice();
var activeCtabId=null;
function saveCtabs(){try{localStorage.setItem('boutiq_ctabs',JSON.stringify(customTabs));}catch(e){}}
function renderCustomTabs(){
  var dyn=document.getElementById('ctab-dynamic');if(!dyn)return;
  var html='';
  customTabs.forEach(function(ct){
    var isActive=activeCtabId===ct.id;
    html+='<div class="ctab-pill'+(isActive?' ctab-active':'')+'" style="'+(isActive?'color:'+ct.color+';border-bottom-color:'+ct.color+';':'')+'" onclick="setCustomTab(\''+ct.id+'\')" ondblclick="editCustomTab(\''+ct.id+'\')" title="Double-tap to edit">'+esc(ct.name)+'</div>';
  });
  dyn.innerHTML=html;
  document.getElementById('ctab-all').className='ctab-pill'+(activeCtabId===null?' ctab-active':'');
}
function setCustomTab(id){
  activeCtabId=id;
  renderCustomTabs();
  renderList();
}
function applyCtabFilters(list){
  if(!activeCtabId)return list;
  var ct=customTabs.find(function(c){return c.id===activeCtabId;});
  if(!ct||!ct.filters)return list;
  var f=ct.filters;
  return list.filter(function(m){
    if(f.vendor&&m.vendor!==f.vendor)return false;
    if(f.tag&&!(m.tags&&m.tags.some(function(t){return t.toLowerCase()===f.tag.toLowerCase();})))return false;
    if(f.stockStatus){
      var oot=m.variants.every(function(v){return (parseInt(v.qty)||0)===0;});
      var low=!oot&&m.variants.some(function(v){var q=parseInt(v.qty)||0;return q>0&&q<=(parseInt(v.minqty)||0);});
      var ss=oot?'out':low?'low':'in_stock';
      if(f.stockStatus!==ss)return false;
    }
    if(f.search){var s=f.search.toLowerCase();if(!m.name.toLowerCase().includes(s)&&!m.sku.toLowerCase().includes(s))return false;}
    return true;
  });
}
// New tab sheet state
var _ctEdit=null;
var _ctColor='#4A3BB5';
function openNewTabSheet(){
  _ctEdit=null;_ctColor='#4A3BB5';
  document.getElementById('newtab-name').value='';
  document.getElementById('newtab-vendor').value='';
  document.getElementById('newtab-tag').value='';
  document.getElementById('newtab-search').value='';
  document.querySelectorAll('.newtab-ss').forEach(function(el){el.classList.remove('fp-chip-on');});
  document.querySelectorAll('.ctab-color-sw').forEach(function(el){el.classList.toggle('ctab-sw-sel',el.getAttribute('data-c')==='#4A3BB5');});
  document.getElementById('sh-newtab-title').textContent='New tab';
  var delBtn=document.getElementById('newtab-del-btn');if(delBtn)delBtn.style.display='none';
  openSheet('sh-newtab');
}
function editCustomTab(id){
  var ct=customTabs.find(function(c){return c.id===id;});if(!ct)return;
  _ctEdit=id;_ctColor=ct.color||'#4A3BB5';
  document.getElementById('newtab-name').value=ct.name||'';
  document.getElementById('newtab-vendor').value=(ct.filters&&ct.filters.vendor)||'';
  document.getElementById('newtab-tag').value=(ct.filters&&ct.filters.tag)||'';
  document.getElementById('newtab-search').value=(ct.filters&&ct.filters.search)||'';
  document.querySelectorAll('.newtab-ss').forEach(function(el){
    el.classList.toggle('fp-chip-on',el.getAttribute('data-ss')===(ct.filters&&ct.filters.stockStatus));
  });
  document.querySelectorAll('.ctab-color-sw').forEach(function(el){el.classList.toggle('ctab-sw-sel',el.getAttribute('data-c')===_ctColor);});
  document.getElementById('sh-newtab-title').textContent='Edit tab';
  var delBtn=document.getElementById('newtab-del-btn');if(delBtn)delBtn.style.display='block';
  openSheet('sh-newtab');
}
function saveCustomTab(){
  var name=(document.getElementById('newtab-name').value||'').trim();
  if(!name){showToast('Enter a tab name');return;}
  var ssEl=document.querySelector('.newtab-ss.fp-chip-on');
  var filters={};
  var v=document.getElementById('newtab-vendor').value;if(v)filters.vendor=v;
  var t=(document.getElementById('newtab-tag').value||'').trim();if(t)filters.tag=t;
  var s=(document.getElementById('newtab-search').value||'').trim();if(s)filters.search=s;
  if(ssEl)filters.stockStatus=ssEl.getAttribute('data-ss');
  if(_ctEdit){
    var idx=customTabs.findIndex(function(c){return c.id===_ctEdit;});
    if(idx>-1){customTabs[idx].name=name;customTabs[idx].color=_ctColor;customTabs[idx].filters=filters;}
  } else {
    customTabs.push({id:'ct'+Date.now(),name:name,color:_ctColor,filters:filters});
  }
  saveCtabs();closeSheet('sh-newtab');renderCustomTabs();showToast('Tab saved');
}
function deleteCustomTab(){
  if(!_ctEdit)return;
  customTabs=customTabs.filter(function(c){return c.id!==_ctEdit;});
  if(activeCtabId===_ctEdit)activeCtabId=null;
  saveCtabs();closeSheet('sh-newtab');renderCustomTabs();renderList();showToast('Tab deleted');
}
function pickCtabColor(el){
  _ctColor=el.getAttribute('data-c');
  document.querySelectorAll('.ctab-color-sw').forEach(function(s){s.classList.remove('ctab-sw-sel');});
  el.classList.add('ctab-sw-sel');
}
function toggleNtSS(el){
  document.querySelectorAll('.newtab-ss').forEach(function(s){s.classList.remove('fp-chip-on');});
  if(!el.classList.contains('fp-chip-on'))el.classList.add('fp-chip-on');
  else el.classList.remove('fp-chip-on');
}
var searchQ='';
var screenStack=[];
var curScreen='list';
var editingId=null;
var editMat=null;
var uploadedImgs=[];
var curVarIdx=null;
var curTagVarIdx=null;
var curCTab=0;
var curVTab=0;

// ═══════════════════════════════
//  NAVIGATION
// ═══════════════════════════════
function showScreen(id){
  document.querySelectorAll('.screen').forEach(function(s){s.classList.remove('on');});
  document.getElementById('s-'+id).classList.add('on');
  curScreen=id;
}
function pushScreen(id){
  screenStack.push(curScreen);
  showScreen(id);
  window.scrollTo(0,0);
}
function goBack(){
  if(screenStack.length){var p=screenStack.pop();showScreen(p);}
  if(curScreen==='list'){renderList();}
}
function goSync(){pushScreen('sync');}
function goSettings(){pushScreen('settings');renderSettingsSets();}

// ═══════════════════════════════
//  COLLECTIONS
// ═══════════════════════════════
var COL_COLORS=['#4A3BB5','#E8703A','#B54A8F','#2D9E6B','#D4A017','#3A7EC8','#7B4FB5','#C0392B'];

function colMaterials(col){
  return materials.filter(function(m){
    var byTag=m.tags&&m.tags.some(function(t){return col.tagRules.includes(t);});
    var byManual=col.manualIds&&col.manualIds.includes(m.id);
    return byTag||byManual;
  });
}

function renderCollections(){
  document.getElementById('col-sub').textContent=collections.length+' collection'+(collections.length!==1?'s':'');
  var html='';
  if(!collections.length){
    html='<div style="padding:40px 16px;text-align:center;color:var(--tx3);font-size:13px;">No collections yet.<br><br><button onclick="openColEdit(null)" style="padding:9px 20px;border-radius:var(--rads);background:var(--p);color:#fff;border:none;cursor:pointer;font-size:13px;font-family:inherit;">+ Create first collection</button></div>';
  } else {
    collections.forEach(function(col){
      var mats=colMaterials(col);
      var totalQty=mats.reduce(function(s,m){return s+m.variants.reduce(function(s2,v){return s2+(parseInt(v.qty)||0);},0);},0);
      var tagCount=col.tagRules.length;
      var manCount=col.manualIds.length;
      html+='<div style="background:var(--sf);border:0.5px solid var(--br);border-radius:var(--rads);margin-bottom:10px;overflow:hidden;">'+
        '<div style="height:4px;background:'+col.color+';"></div>'+
        '<div style="padding:13px 14px;">'+
          '<div style="display:flex;align-items:flex-start;justify-content:space-between;gap:8px;">'+
            '<div style="flex:1;min-width:0;">'+
              '<div style="font-size:14px;font-weight:600;color:var(--tx);margin-bottom:3px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">'+esc(col.name)+'</div>'+
              (col.desc?'<div style="font-size:11px;color:var(--tx2);margin-bottom:8px;line-height:1.4;">'+esc(col.desc)+'</div>':'<div style="margin-bottom:8px;"></div>')+
              '<div style="display:flex;gap:12px;font-size:11px;color:var(--tx3);">'+
                '<span><b style="color:var(--tx);font-size:13px;">'+mats.length+'</b> products</span>'+
                '<span><b style="color:var(--tx);font-size:13px;">'+totalQty+'</b> in stock</span>'+
                (tagCount?'<span style="color:var(--pt);background:var(--pl);padding:2px 7px;border-radius:10px;">'+tagCount+' tag rule'+(tagCount!==1?'s':'')+'</span>':'')+
              '</div>'+
            '</div>'+
            '<button onclick="openColEdit(\''+col.id+'\')" style="flex-shrink:0;padding:6px 12px;border-radius:var(--rads);background:var(--sf2);border:0.5px solid var(--br);color:var(--tx2);font-size:12px;cursor:pointer;font-family:inherit;">Edit</button>'+
          '</div>'+
          // mini product strip
          (mats.length?'<div style="display:flex;gap:5px;margin-top:10px;flex-wrap:wrap;">'+
            mats.slice(0,6).map(function(m){
              var img=m.imgs&&m.imgs.length?'<img src="'+m.imgs[0]+'" style="width:100%;height:100%;object-fit:cover;border-radius:5px;">':'<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="var(--tx3)" stroke-width="1.8"><path d="M20.38 3.46L16 2a4 4 0 0 1-8 0L3.62 3.46a2 2 0 0 0-1.34 2.23l.58 3.57a1 1 0 0 0 .99.84H6v10a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V10h2.15a1 1 0 0 0 .99-.84l.58-3.57a2 2 0 0 0-1.34-2.23z"/></svg>';
              return '<div style="width:40px;height:40px;border-radius:6px;background:var(--sf2);border:0.5px solid var(--br);display:flex;align-items:center;justify-content:center;overflow:hidden;flex-shrink:0;">'+img+'</div>';
            }).join('')+
            (mats.length>6?'<div style="width:40px;height:40px;border-radius:6px;background:var(--sf2);border:0.5px solid var(--br);display:flex;align-items:center;justify-content:center;font-size:11px;color:var(--tx2);">+'+( mats.length-6)+'</div>':'')
          +'</div>':'<div style="padding:8px 0;font-size:12px;color:var(--tx3);font-style:italic;">No products yet — add tag rules or pick manually.</div>')+
        '</div>'+
      '</div>';
    });
  }
  html+='<div style="height:20px;"></div>';
  document.getElementById('col-list').innerHTML=html;
}

function openColEdit(id){
  _colEditId=id;
  _colEditObj=id?JSON.parse(JSON.stringify(collections.find(function(c){return c.id===id;}))):
    {id:'col-'+Date.now(),name:'',desc:'',color:COL_COLORS[0],icon:'folder',manualIds:[],tagRules:[],createdAt:new Date().toISOString().slice(0,10)};
  document.getElementById('sh-coledit-title').textContent=id?'Edit collection':'New collection';
  document.getElementById('col-name-inp').value=_colEditObj.name||'';
  document.getElementById('col-desc-inp').value=_colEditObj.desc||'';
  document.getElementById('col-del-btn').style.display=id?'':'none';
  renderColColorRow();
  renderColTagChips();
  renderColManualList();
  renderColPreview();
  closeSheet('sh-addtocol');
  openSheet('sh-coledit');
}

function renderColColorRow(){
  document.getElementById('col-color-row').innerHTML=COL_COLORS.map(function(clr){
    var sel=clr===(_colEditObj.color||COL_COLORS[0]);
    return '<div onclick="_colEditObj.color=\''+clr+'\';renderColColorRow();" style="width:28px;height:28px;border-radius:50%;background:'+clr+';cursor:pointer;border:2.5px solid '+(sel?'var(--tx)':'transparent')+';box-shadow:'+(sel?'0 0 0 2px var(--sf)':'none')+';transition:all 0.15s;"></div>';
  }).join('');
}

function addColTag(){
  var inp=document.getElementById('col-tag-inp');
  var t=(inp.value||'').trim().toLowerCase().replace(/\s+/g,'-');
  if(!t)return;
  if(_colEditObj.tagRules.includes(t)){showToast('Tag already added');return;}
  _colEditObj.tagRules.push(t);
  inp.value='';
  renderColTagChips();
  renderColPreview();
}

function removeColTag(idx){
  _colEditObj.tagRules.splice(idx,1);
  renderColTagChips();
  renderColPreview();
}

function renderColTagChips(){
  var tagMats=_colEditObj.tagRules.length?materials.filter(function(m){return m.tags&&m.tags.some(function(t){return _colEditObj.tagRules.includes(t);});}):[];
  // chips
  document.getElementById('col-tag-chips').innerHTML=_colEditObj.tagRules.map(function(t,i){
    return '<span style="display:inline-flex;align-items:center;gap:5px;padding:4px 9px;border-radius:20px;font-size:12px;font-weight:500;background:var(--pl);color:var(--pt);border:0.5px solid var(--pm);">'+esc(t)+'<span onclick="removeColTag('+i+')" style="cursor:pointer;font-size:14px;line-height:1;color:var(--p);font-weight:400;">×</span></span>';
  }).join('');
  // tag suggestions from existing material tags
  var allTags=[];
  materials.forEach(function(m){(m.tags||[]).forEach(function(t){if(!allTags.includes(t)&&!_colEditObj.tagRules.includes(t))allTags.push(t);});});
  var sugg=document.getElementById('col-tag-suggestions');
  if(allTags.length){
    sugg.innerHTML='<div style="font-size:10px;color:var(--tx3);margin-bottom:5px;text-transform:uppercase;letter-spacing:0.4px;">Existing tags</div><div style="display:flex;flex-wrap:wrap;gap:5px;">'+
      allTags.slice(0,12).map(function(t){
        return '<span onclick="_colEditObj.tagRules.push(\''+t+'\');renderColTagChips();renderColPreview();" style="padding:3px 9px;border-radius:20px;font-size:11px;background:var(--sf2);border:0.5px solid var(--br2);color:var(--tx2);cursor:pointer;">+ '+esc(t)+'</span>';
      }).join('')+'</div>';
  } else { sugg.innerHTML=''; }
}

function renderColManualList(){
  document.getElementById('col-manual-list').innerHTML=materials.map(function(m){
    var checked=_colEditObj.manualIds.includes(m.id);
    var byTag=m.tags&&m.tags.some(function(t){return _colEditObj.tagRules.includes(t);});
    return '<label style="display:flex;align-items:center;gap:9px;padding:5px 2px;cursor:pointer;border-bottom:0.5px solid var(--br);font-size:12px;color:var(--tx);">'+
      '<input type="checkbox" '+(checked?'checked':'')+' onchange="toggleColManual('+m.id+',this.checked)" style="accent-color:var(--p);width:14px;height:14px;flex-shrink:0;"/>'+
      '<span style="flex:1;min-width:0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">'+esc(m.name)+'</span>'+
      (byTag?'<span style="font-size:10px;color:var(--pt);background:var(--pl);padding:1px 6px;border-radius:10px;flex-shrink:0;">tag</span>':'')+
    '</label>';
  }).join('');
}

function toggleColManual(id,checked){
  var idx=_colEditObj.manualIds.indexOf(id);
  if(checked&&idx===-1)_colEditObj.manualIds.push(id);
  else if(!checked&&idx>-1)_colEditObj.manualIds.splice(idx,1);
  renderColPreview();
}

function renderColPreview(){
  var mats=colMaterials(_colEditObj);
  document.getElementById('col-preview-count').textContent='('+mats.length+' product'+(mats.length!==1?'s':'')+')';
  document.getElementById('col-preview-list').innerHTML=mats.length?
    mats.map(function(m){
      var byTag=m.tags&&m.tags.some(function(t){return _colEditObj.tagRules.includes(t);});
      var byManual=_colEditObj.manualIds.includes(m.id);
      return '<div style="display:flex;align-items:center;gap:8px;padding:4px 2px;border-bottom:0.5px solid var(--br);">'+
        '<div style="width:28px;height:28px;border-radius:5px;background:var(--sf2);border:0.5px solid var(--br);display:flex;align-items:center;justify-content:center;flex-shrink:0;overflow:hidden;">'+(m.imgs&&m.imgs.length?'<img src="'+m.imgs[0]+'" style="width:100%;height:100%;object-fit:cover;">':'<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="var(--tx3)" stroke-width="1.8"><path d="M20.38 3.46L16 2a4 4 0 0 1-8 0L3.62 3.46a2 2 0 0 0-1.34 2.23l.58 3.57a1 1 0 0 0 .99.84H6v10a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V10h2.15a1 1 0 0 0 .99-.84l.58-3.57a2 2 0 0 0-1.34-2.23z"/></svg>')+'</div>'+
        '<span style="flex:1;font-size:12px;color:var(--tx);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">'+esc(m.name)+'</span>'+
        '<span style="font-size:10px;color:var(--tx3);">'+(byTag&&byManual?'tag + manual':byTag?'via tag':'manual')+'</span>'+
      '</div>';
    }).join(''):
    '<div style="font-size:12px;color:var(--tx3);padding:8px 0;">No products match yet.</div>';
}

function saveCollection(){
  var name=(document.getElementById('col-name-inp').value||'').trim();
  if(!name){showToast('Please enter a name');return;}
  _colEditObj.name=name;
  _colEditObj.desc=(document.getElementById('col-desc-inp').value||'').trim();
  if(_colEditId){
    var idx=collections.findIndex(function(c){return c.id===_colEditId;});
    if(idx>-1)collections[idx]=_colEditObj;
  } else {
    collections.push(_colEditObj);
  }
  closeSheet('sh-coledit');
  showToast('Collection saved ✓');
  if(curScreen==='collections')renderCollections();
}

function deleteCollection(){
  if(!_colEditId)return;
  if(!confirm('Delete this collection?'))return;
  collections=collections.filter(function(c){return c.id!==_colEditId;});
  closeSheet('sh-coledit');
  showToast('Collection deleted');
  if(curScreen==='collections')renderCollections();
}

function openAddToCol(matId){
  _addToColMatId=matId;
  var m=materials.find(function(x){return x.id===matId;});
  if(!m)return;
  var html='<div style="padding:6px 14px 10px;"><div style="font-size:13px;font-weight:500;color:var(--tx);margin-bottom:2px;">'+esc(m.name)+'</div><div style="font-size:11px;color:var(--tx3);">Select collections to add this product to</div></div>';
  if(!collections.length){
    html+='<div style="padding:12px 14px;font-size:13px;color:var(--tx3);">No collections yet.</div>';
  } else {
    collections.forEach(function(col){
      var inManual=col.manualIds.includes(matId);
      var inTag=m.tags&&m.tags.some(function(t){return col.tagRules.includes(t);});
      var included=inManual||inTag;
      html+='<div style="display:flex;align-items:center;gap:11px;padding:11px 14px;border-bottom:0.5px solid var(--br);">'+
        '<div style="width:8px;height:8px;border-radius:50%;background:'+col.color+';flex-shrink:0;"></div>'+
        '<div style="flex:1;min-width:0;">'+
          '<div style="font-size:13px;color:var(--tx);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">'+esc(col.name)+'</div>'+
          (inTag?'<div style="font-size:10px;color:var(--pt);">Already included via tag rule</div>':'')+
        '</div>'+
        (inTag?
          '<span style="font-size:11px;color:var(--pt);background:var(--pl);padding:3px 8px;border-radius:10px;flex-shrink:0;">auto</span>':
          '<button onclick="toggleAddToCol(\''+col.id+'\')" id="atcbtn-'+col.id+'" style="flex-shrink:0;padding:5px 12px;border-radius:var(--rads);background:'+(inManual?'var(--p)':'var(--sf2)')+';color:'+(inManual?'#fff':'var(--tx2)')+';border:0.5px solid '+(inManual?'var(--p)':'var(--br2)')+';font-size:12px;font-weight:500;cursor:pointer;font-family:inherit;">'+(inManual?'✓ Added':'Add')+'</button>')+
      '</div>';
    });
  }
  document.getElementById('sh-addtocol-body').innerHTML=html;
  openSheet('sh-addtocol');
}

function toggleAddToCol(colId){
  var col=collections.find(function(c){return c.id===colId;});
  if(!col)return;
  var idx=col.manualIds.indexOf(_addToColMatId);
  if(idx>-1){col.manualIds.splice(idx,1);showToast('Removed from collection');}
  else{col.manualIds.push(_addToColMatId);showToast('Added to collection ✓');}
  openAddToCol(_addToColMatId); // re-render sheet
  renderList(); // update dot indicator on card
}
function goReports(){pushScreen('reports');}
function navGo(dest){
  closeSheet('sh-nav');
  document.querySelectorAll('.nav-item').forEach(function(el){el.classList.remove('on');});
  var ni=document.getElementById('nav-'+dest);if(ni)ni.classList.add('on');
  if(dest==='list'){screenStack=[];showScreen('list');renderList();}
  if(dest==='collections'){screenStack=[];showScreen('collections');renderCollections();}
  else if(dest==='reports'){pushScreen('reports');renderReportList();}
  else if(dest==='sync'){pushScreen('sync');}
  else if(dest==='labels'){goLabels();}
  else if(dest==='settings'){pushScreen('settings');renderSettingsSets();}
}
function renderReportList(){
  // summary stats
  var total=materials.length;
  var totalVariants=materials.reduce(function(s,m){return s+m.variants.length;},0);
  var totalStock=materials.reduce(function(s,m){return s+m.variants.reduce(function(ss,v){return ss+(parseInt(v.qty)||0);},0);},0);
  var lowStock=materials.reduce(function(s,m){return s+m.variants.filter(function(v){return (parseInt(v.qty)||0)<=(v.minqty||0)&&(v.minqty||0)>0;}).length;},0);
  var el=document.getElementById('rpt-output');if(el)el.style.display='none';
  // update stat bar if we add one later
}
function openReport(type){
  var el=document.getElementById('rpt-output');
  if(!el)return;
  el.style.display='block';
  var html='';
  if(type==='stock-summary'){
    html='<div style="font-size:13px;font-weight:500;color:var(--tx);padding:0 0 8px;">Stock summary</div>';
    html+='<div style="background:var(--sf);border-radius:var(--rad);border:0.5px solid var(--br);overflow:hidden;">';
    html+='<div style="display:grid;grid-template-columns:1fr auto auto;padding:8px 12px;border-bottom:0.5px solid var(--br);font-size:10px;font-weight:500;color:var(--tx3);text-transform:uppercase;letter-spacing:0.3px;gap:10px;"><span>Product / variant</span><span>Type</span><span style="text-align:right;">Qty</span></div>';
    materials.slice().sort(function(a,b){return a.name.localeCompare(b.name);}).forEach(function(m){
      var tq=m.variants.reduce(function(s,v){return s+(parseInt(v.qty)||0);},0);
      html+='<div style="display:grid;grid-template-columns:1fr auto auto;padding:9px 12px;border-bottom:0.5px solid var(--br);gap:10px;align-items:center;">';
      html+='<div><div style="font-size:12px;font-weight:500;color:var(--tx);">'+esc(m.name)+'</div><div style="font-size:10px;color:var(--tx3);font-family:monospace;">'+esc(m.sku)+'</div></div>';
      html+='<span style="font-size:11px;padding:2px 7px;border-radius:4px;background:'+(m.type==='raw'?'var(--gl)':m.type==='production'?'var(--al)':'var(--pl)')+';color:'+(m.type==='raw'?'var(--gt)':m.type==='production'?'var(--at)':'var(--pt)')+';">'+(m.type==='raw'?'Raw':m.type==='production'?'Prod':'Finished')+'</span>';
      html+='<span style="font-size:13px;font-weight:500;text-align:right;color:'+(tq===0?'var(--r)':'var(--g)')+'">'+tq+'</span>';
      html+='</div>';
    });
    html+='</div>';
  } else if(type==='low-stock'){
    html='<div style="font-size:13px;font-weight:500;color:var(--tx);padding:0 0 8px;">Low stock alert</div>';
    var rows=[];
    materials.forEach(function(m){m.variants.forEach(function(v){if((parseInt(v.qty)||0)<=(v.minqty||0)&&(v.minqty||0)>0)rows.push({mat:m,var:v});});});
    if(!rows.length){html+='<div style="padding:20px;text-align:center;font-size:13px;color:var(--g);background:var(--sf);border-radius:var(--rad);border:0.5px solid var(--br);">✓ All variants are above minimum quantity</div>';}
    else{
      html+='<div style="background:var(--sf);border-radius:var(--rad);border:0.5px solid var(--br);overflow:hidden;">';
      rows.forEach(function(r){
        html+='<div style="display:flex;align-items:center;justify-content:space-between;padding:10px 12px;border-bottom:0.5px solid var(--br);">';
        html+='<div><div style="font-size:12px;font-weight:500;color:var(--tx);">'+esc(r.mat.name)+' — '+esc(r['var'].name)+'</div><div style="font-size:10px;color:var(--tx3);">Min: '+r['var'].minqty+'</div></div>';
        html+='<span style="font-size:14px;font-weight:500;color:var(--r);">'+(parseInt(r['var'].qty)||0)+'</span>';
        html+='</div>';
      });
      html+='</div>';
    }
  } else if(type==='zero-stock'){
    html='<div style="font-size:13px;font-weight:500;color:var(--tx);padding:0 0 8px;">Out of stock</div>';
    var rows=[];
    materials.forEach(function(m){m.variants.forEach(function(v){if((parseInt(v.qty)||0)===0)rows.push({mat:m,var:v});});});
    html+='<div style="background:var(--sf);border-radius:var(--rad);border:0.5px solid var(--br);overflow:hidden;">';
    rows.forEach(function(r){
      html+='<div style="display:flex;align-items:center;justify-content:space-between;padding:10px 12px;border-bottom:0.5px solid var(--br);">';
      html+='<div><div style="font-size:12px;font-weight:500;color:var(--tx);">'+esc(r.mat.name)+'</div><div style="font-size:10px;color:var(--tx3);font-family:monospace;">'+esc(r['var'].sku)+'</div></div>';
      html+='<span style="font-size:11px;padding:2px 8px;border-radius:20px;background:var(--rl);color:var(--rt);font-weight:500;">Out of stock</span>';
      html+='</div>';
    });
    if(!rows.length)html+='<div style="padding:20px;text-align:center;font-size:13px;color:var(--g);">✓ No variants are out of stock</div>';
    html+='</div>';
  } else if(type==='vendor-wise'){
    html='<div style="font-size:13px;font-weight:500;color:var(--tx);padding:0 0 8px;">Vendor-wise inventory</div>';
    var byVendor={};
    materials.forEach(function(m){
      var vname=(m.vendors&&m.vendors.length)?m.vendors[0].name:'Unassigned';
      if(!byVendor[vname])byVendor[vname]={lead:(m.vendors&&m.vendors[0])?m.vendors[0].lead:'',items:[],qty:0};
      var tq=m.variants.reduce(function(s,v){return s+(parseInt(v.qty)||0);},0);
      byVendor[vname].items.push(m);byVendor[vname].qty+=tq;
    });
    Object.keys(byVendor).sort().forEach(function(vname){
      var g=byVendor[vname];
      html+='<div style="background:var(--sf);border-radius:var(--rad);border:0.5px solid var(--br);overflow:hidden;margin-bottom:8px;">';
      html+='<div style="display:flex;align-items:center;justify-content:space-between;padding:10px 12px;border-bottom:0.5px solid var(--br);background:var(--sf2);">';
      html+='<div><div style="font-size:13px;font-weight:500;color:var(--tx);">'+esc(vname)+'</div>'+(g.lead?'<div style="font-size:11px;color:var(--tx2);">Lead: '+esc(g.lead)+'</div>':'')+'</div>';
      html+='<span style="font-size:14px;font-weight:500;color:var(--p);">'+g.qty+' units</span>';
      html+='</div>';
      g.items.forEach(function(m){
        var tq=m.variants.reduce(function(s,v){return s+(parseInt(v.qty)||0);},0);
        html+='<div style="display:flex;align-items:center;justify-content:space-between;padding:9px 12px;border-bottom:0.5px solid var(--br);font-size:12px;"><span style="color:var(--tx);">'+esc(m.name)+'</span><span style="font-weight:500;color:'+(tq?'var(--tx)':'var(--r)')+'">'+tq+'</span></div>';
      });
      html+='</div>';
    });
  } else if(type==='valuation'){
    html='<div style="font-size:13px;font-weight:500;color:var(--tx);padding:0 0 8px;">Inventory valuation</div>';
    var byType={finished:{qty:0,val:0},raw:{qty:0,val:0},production:{qty:0,val:0}};
    materials.forEach(function(m){
      m.variants.forEach(function(v){
        var q=parseInt(v.qty)||0;var c=parseFloat(v.cost)||0;
        if(byType[m.type]){byType[m.type].qty+=q;byType[m.type].val+=q*c;}
      });
    });
    var totalVal=Object.values(byType).reduce(function(s,t){return s+t.val;},0);
    html+='<div style="background:var(--sf);border-radius:var(--rad);border:0.5px solid var(--br);overflow:hidden;margin-bottom:8px;">';
    [['finished','Finished goods','var(--pl)','var(--pt)'],['raw','Raw materials','var(--gl)','var(--gt)'],['production','Production','var(--al)','var(--at)']].forEach(function(row){
      var t=byType[row[0]];
      html+='<div style="display:flex;align-items:center;justify-content:space-between;padding:11px 12px;border-bottom:0.5px solid var(--br);">';
      html+='<div style="display:flex;align-items:center;gap:8px;"><span style="font-size:11px;padding:2px 8px;border-radius:4px;background:'+row[2]+';color:'+row[3]+';">'+row[1]+'</span></div>';
      html+='<div style="text-align:right;"><div style="font-size:13px;font-weight:500;color:var(--p);">Rs. '+Math.round(t.val).toLocaleString('en-IN')+'</div><div style="font-size:11px;color:var(--tx2);">'+t.qty+' units</div></div>';
      html+='</div>';
    });
    html+='<div style="display:flex;align-items:center;justify-content:space-between;padding:11px 12px;background:var(--sf2);">';
    html+='<span style="font-size:13px;font-weight:500;color:var(--tx);">Total inventory value</span>';
    html+='<span style="font-size:15px;font-weight:500;color:var(--p);">Rs. '+Math.round(totalVal).toLocaleString('en-IN')+'</span>';
    html+='</div></div>';
  } else if(type==='movement'){
    html='<div style="font-size:13px;font-weight:500;color:var(--tx);padding:0 0 8px;">Stock movement log</div>';
    html+='<div style="background:var(--sf);border-radius:var(--rad);border:0.5px solid var(--br);overflow:hidden;">';
    [{date:'21 Sep 2026',mat:'Blue Offshoulder — S/Blue',type:'in',qty:'+12',ref:'PO-0341'},{date:'21 Sep 2026',mat:'Pink Palazzo — S',type:'out',qty:'−3',ref:'SO-0892'},{date:'20 Sep 2026',mat:'Ivory Cotton Palazzo — S',type:'adj',qty:'+2',ref:'ADJ-011'},{date:'20 Sep 2026',mat:'Navy Anarkali — S',type:'out',qty:'−1',ref:'SO-0891'},{date:'19 Sep 2026',mat:'Coral Short Kurta — M',type:'in',qty:'+6',ref:'PO-0340'}].forEach(function(r){
      var bg={in:'var(--gl)',out:'var(--rl)',adj:'var(--al)'}[r.type];
      var tc={in:'var(--gt)',out:'var(--rt)',adj:'var(--at)'}[r.type];
      html+='<div style="display:flex;align-items:center;gap:10px;padding:10px 12px;border-bottom:0.5px solid var(--br);">';
      html+='<div style="width:28px;height:28px;border-radius:50%;background:'+bg+';display:flex;align-items:center;justify-content:center;flex-shrink:0;font-size:11px;font-weight:500;color:'+tc+';"></div>';
      html+='<div style="flex:1;"><div style="font-size:12px;color:var(--tx);">'+esc(r.mat)+'</div><div style="font-size:10px;color:var(--tx3);">'+r.date+' · '+r.ref+'</div></div>';
      html+='<span style="font-size:13px;font-weight:500;color:'+tc+';">'+r.qty+'</span>';
      html+='</div>';
    });
    html+='</div>';
  }
  el.innerHTML='<div style="padding:12px 0 4px;font-size:11px;font-weight:500;color:var(--tx2);text-transform:uppercase;letter-spacing:0.3px;">Results</div>'+html+'<button onclick="document.getElementById(\'rpt-output\').style.display=\'none\'" style="margin-top:10px;width:100%;padding:9px;border-radius:var(--rads);border:0.5px solid var(--br2);background:var(--sf2);color:var(--tx2);font-size:12px;cursor:pointer;font-family:inherit;">Close report</button>';
  el.scrollIntoView({behavior:'smooth',block:'start'});
}

// ═══════════════════════════════
//  SETTINGS — OPTION SETS
// ═══════════════════════════════
function renderSettingsSets(){
  var el=document.getElementById('settings-sets-list');
  if(!el)return;
  // group by cat
  var byCat={};
  optionSets.forEach(function(s){
    if(!byCat[s.cat])byCat[s.cat]=[];
    byCat[s.cat].push(s);
  });
  var cats=Object.keys(byCat).sort();
  var html='';
  cats.forEach(function(cat){
    html+='<div style="padding:11px 14px 5px;font-size:11px;font-weight:500;color:var(--tx2);text-transform:uppercase;letter-spacing:0.3px;">'+esc(cat)+'</div>';
    byCat[cat].forEach(function(s){
      html+='<div style="background:var(--sf);margin:0 12px 7px;border-radius:var(--rad);border:0.5px solid var(--br);overflow:hidden;">'+
        '<div style="display:flex;align-items:center;gap:9px;padding:11px 14px;border-bottom:0.5px solid var(--br);">'+
          '<div style="flex:1;min-width:0;">'+
            '<div style="font-size:13px;font-weight:500;color:var(--tx);">'+esc(s.name)+'</div>'+
            '<div style="font-size:11px;color:var(--tx2);margin-top:2px;">'+s.values.length+' values'+(s.system?' · System default':'')+'</div>'+
          '</div>'+
          '<div style="display:flex;gap:6px;">'+
            (!s.system?'<button style="padding:5px 10px;border-radius:6px;border:0.5px solid var(--br2);background:var(--sf2);color:var(--tx2);font-size:11px;cursor:pointer;font-family:inherit;" onclick="editSet(\''+s.id+'\')"><svg style="font-size:12px;vertical-align:-1px;" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7M18.5 2.5a2.12 2.12 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg> Edit</button>':''+
            '<button style="padding:5px 10px;border-radius:6px;border:0.5px solid var(--br2);background:var(--sf2);color:var(--tx2);font-size:11px;cursor:pointer;font-family:inherit;" onclick="duplicateSet(\''+s.id+'\')"><svg style="font-size:12px;vertical-align:-1px;" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M8 4H6a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-4-4H8v4h8M8 12h8M8 16h4"/></svg> Duplicate</button>')+
            (!s.system?'<button style="padding:5px 10px;border-radius:6px;border:0.5px solid #F7C1C1;background:var(--rl);color:var(--rt);font-size:11px;cursor:pointer;font-family:inherit;" onclick="deleteSet(\''+s.id+'\')"><svg style="font-size:12px;vertical-align:-1px;" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 6h18M8 6V4h8v2M19 6l-1 14H6L5 6"/></svg></button>':'')+
          '</div>'+
        '</div>'+
        '<div style="display:flex;flex-wrap:wrap;gap:5px;padding:9px 14px;">'+
          s.values.map(function(v){return '<span style="padding:3px 9px;border-radius:20px;font-size:11px;font-weight:500;background:var(--pl);color:var(--pt);border:0.5px solid var(--pm);">'+esc(v)+'</span>';}).join('')+
        '</div>'+
      '</div>';
    });
  });
  if(!cats.length)html='<div style="padding:32px 16px;text-align:center;font-size:13px;color:var(--tx3);">No variant categories yet. Tap + New set to create one.</div>';
  el.innerHTML=html;
}

var _editingSetId=null;
var _nsVals=[];

function openNewSet(){
  _editingSetId=null;_nsVals=[];
  document.getElementById('sh-newset-title').textContent='New variant category';
  document.getElementById('ns-cat').value='';
  document.getElementById('ns-name').value='';
  document.getElementById('ns-chips').innerHTML='';
  document.getElementById('ns-val-inp').value='';
  openSheet('sh-newset');
}
function editSet(id){
  var s=optionSets.find(function(x){return x.id===id;});if(!s||s.system)return;
  _editingSetId=id;_nsVals=s.values.slice();
  document.getElementById('sh-newset-title').textContent='Edit variant category';
  document.getElementById('ns-cat').value=s.cat;
  document.getElementById('ns-name').value=s.name;
  renderNSChips();
  openSheet('sh-newset');
}
function duplicateSet(id){
  var s=optionSets.find(function(x){return x.id===id;});if(!s)return;
  var dup={id:'cust-'+Date.now(),cat:s.cat,name:s.name+' (copy)',values:s.values.slice(),system:false};
  optionSets.push(dup);
  renderSettingsSets();
  showToast('Set duplicated — tap Edit to customise');
}
function deleteSet(id){
  if(!confirm('Delete this variant category?'))return;
  var i=optionSets.findIndex(function(x){return x.id===id;});
  if(i>-1)optionSets.splice(i,1);
  renderSettingsSets();
  showToast('Set deleted');
}
function nsAddVal(){
  var inp=document.getElementById('ns-val-inp');
  var v=(inp.value||'').trim();if(!v)return;
  if(_nsVals.includes(v)){showToast('"'+v+'" already added');return;}
  _nsVals.push(v);inp.value='';renderNSChips();
}
function nsRemoveVal(i){_nsVals.splice(i,1);renderNSChips();}
function renderNSChips(){
  var el=document.getElementById('ns-chips');if(!el)return;
  el.innerHTML=_nsVals.map(function(v,i){
    return '<span class="val-chip custom-s">'+esc(v)+'<span class="val-del" onclick="nsRemoveVal('+i+')">×</span></span>';
  }).join('');
}
function saveNewSet(){
  var cat=(document.getElementById('ns-cat').value||'').trim();
  var name=(document.getElementById('ns-name').value||'').trim();
  if(!cat){showToast('Enter a category name');return;}
  if(!name){showToast('Enter a set name');return;}
  if(!_nsVals.length){showToast('Add at least one value');return;}
  if(_editingSetId){
    var s=optionSets.find(function(x){return x.id===_editingSetId;});
    if(s){s.cat=cat;s.name=name;s.values=_nsVals.slice();}
  } else {
    optionSets.push({id:'cust-'+Date.now(),cat:cat,name:name,values:_nsVals.slice(),system:false});
  }
  closeSheet('sh-newset');
  renderSettingsSets();
  showToast(_editingSetId?'Set updated ✓':'Variant category saved ✓');
}

// ═══════════════════════════════
//  PRESET PICKER
// ═══════════════════════════════
var _presetForCatIdx=null;

function buildPresetDropdownHTML(ci,cat){
  var sets=optionSets.filter(function(s){return s.cat.toLowerCase()===cat.name.toLowerCase();});
  if(!sets.length)return '<div style="padding:12px 14px;font-size:12px;color:var(--tx3);">No presets yet. <button onclick="goSettings()" style="color:var(--p);background:none;border:none;cursor:pointer;font-size:12px;font-family:inherit;padding:0;">Create one →</button></div>';
  var html='';
  sets.forEach(function(s,si){
    var allSelected=s.values.every(function(v){return cat.values.includes(v);});
    var safeId=si; // use index not id string to avoid quote issues in onclick
    html+='<div style="border-bottom:0.5px solid var(--br);">'+
      '<div style="display:flex;align-items:center;justify-content:space-between;padding:9px 14px 5px;">'+
        '<span style="font-size:12px;font-weight:500;color:var(--tx);">'+esc(s.name)+'</span>'+
        '<button onclick="applyPresetByIdx('+ci+','+si+')" style="padding:3px 10px;border-radius:6px;background:'+(allSelected?'var(--gl)':'var(--p)')+';color:'+(allSelected?'var(--gt)':'#fff')+';border:none;font-size:11px;font-weight:500;cursor:pointer;font-family:inherit;">'+(allSelected?'✓ All added':'Select all')+'</button>'+
      '</div>'+
      '<div style="display:flex;flex-wrap:wrap;gap:6px;padding:4px 14px 10px;">';
    s.values.forEach(function(v,vi){
      var has=cat.values.includes(v);
      html+='<label style="display:inline-flex;align-items:center;gap:5px;padding:5px 10px;border-radius:20px;font-size:12px;cursor:pointer;border:0.5px solid '+(has?'var(--pm)':'var(--br2)')+';background:'+(has?'var(--pl)':'var(--sf)')+';color:'+(has?'var(--pt)':'var(--tx2)')+';user-select:none;">'+
        '<input type="checkbox" '+(has?'checked':'')+' onchange="togglePresetValByIdx('+ci+','+si+','+vi+',this.checked)" style="accent-color:var(--p);width:13px;height:13px;cursor:pointer;"/>'+
        esc(v)+'</label>';
    });
    html+='</div></div>';
  });
  html+='<div style="padding:7px 14px 9px;"><button onclick="goSettings()" style="font-size:11px;color:var(--tx3);background:none;border:none;cursor:pointer;font-family:inherit;">⚙ Manage variant categories</button></div>';
  return html;
}

function togglePresetDropdown(ci){
  var dd=document.getElementById('preset-dd-'+ci);
  var arr=document.getElementById('preset-arr-'+ci);
  if(!dd)return;
  var open=dd.style.display==='none';
  dd.style.display=open?'block':'none';
  if(arr)arr.style.transform=open?'rotate(180deg)':'rotate(0deg)';
  if(open)dd.innerHTML=buildPresetDropdownHTML(ci,editMat.cats[ci]);
}

function applyPresetByIdx(ci,si){
  var cat=editMat.cats[ci];
  var sets=optionSets.filter(function(s){return s.cat.toLowerCase()===cat.name.toLowerCase();});
  var s=sets[si];if(!s)return;
  s.values.forEach(function(v){if(!cat.values.includes(v))cat.values.push(v);});
  var dd=document.getElementById('preset-dd-'+ci);
  if(dd&&dd.style.display!=='none')dd.innerHTML=buildPresetDropdownHTML(ci,cat);
  rebuildVariantsPage();
}

function togglePresetValByIdx(ci,si,vi,checked){
  var cat=editMat.cats[ci];
  var sets=optionSets.filter(function(s){return s.cat.toLowerCase()===cat.name.toLowerCase();});
  var s=sets[si];if(!s)return;
  var val=s.values[vi];if(val===undefined)return;
  var idx=cat.values.indexOf(val);
  if(checked&&idx===-1)cat.values.push(val);
  else if(!checked&&idx>-1)cat.values.splice(idx,1);
  var dd=document.getElementById('preset-dd-'+ci);
  if(dd&&dd.style.display!=='none')dd.innerHTML=buildPresetDropdownHTML(ci,cat);
  // update chips in place
  var chips=document.querySelector('#opt-list > div:nth-child('+(ci+1)+') .val-chips');
  if(chips){
    chips.innerHTML=cat.values.map(function(v,vi2){
      return '<span class="val-chip '+cat.style+'">'+esc(v)+'<span class="val-del" onclick="delVal('+ci+','+vi2+')" aria-label="Remove">×</span></span>';
    }).join('');
    var countEl=document.querySelector('#opt-list > div:nth-child('+(ci+1)+') .opt-cat-count');
    if(countEl)countEl.textContent=cat.values.length+' value'+(cat.values.length!==1?'s':'');
  }
}

function applyPreset(setId,ci){
  var s=optionSets.find(function(x){return x.id===setId;});if(!s)return;
  var cat=editMat.cats[ci];
  s.values.forEach(function(v){if(!cat.values.includes(v))cat.values.push(v);});
  var dd=document.getElementById('preset-dd-'+ci);
  if(dd&&dd.style.display!=='none')dd.innerHTML=buildPresetDropdownHTML(ci,cat);
  rebuildVariantsPage();
}

function togglePresetVal(setId,val,ci,checked){
  var cat=editMat.cats[ci];
  var idx=cat.values.indexOf(val);
  if(checked&&idx===-1)cat.values.push(val);
  else if(!checked&&idx>-1)cat.values.splice(idx,1);
  var dd=document.getElementById('preset-dd-'+ci);
  if(dd&&dd.style.display!=='none')dd.innerHTML=buildPresetDropdownHTML(ci,cat);
  rebuildVariantsPage();
}


// ═══════════════════════════════
//  LIST
// ═══════════════════════════════
function renderList(){
  var data=applyF(materials);
  data=applyCtabFilters(data);
  var total=data.length;
  var totalPages=Math.max(1,Math.ceil(total/PAGE_SIZE));
  if(curPage>totalPages)curPage=totalPages;
  var pageData=data.slice((curPage-1)*PAGE_SIZE, curPage*PAGE_SIZE);
  document.getElementById('list-sub').textContent='VB Asansol · '+materials.length+' products';
  document.getElementById('list-meta').textContent=total+' products · '+data.reduce(function(s,m){return s+m.variants.length;},0)+' variants';
  var html='';
  pageData.forEach(function(m){
    var tq=m.variants.reduce(function(s,v){return s+(parseInt(v.qty)||0);},0);
    var qc=tq===0?'lo':'ok';
    var exp=expandedIds[m.id];
    var bcls=m.type==='raw'?'raw':m.type==='production'?'production':'finished';
    var blbl=m.type==='raw'?'Raw':m.type==='production'?'Production':'Finished';
    html+='<div class="mat-card"><div class="mrow" onclick="openMDetail('+m.id+')">';
    if(m.imgs&&m.imgs.length)html+='<div class="mth"><img src="'+m.imgs[0]+'" alt=""/></div>';
    else html+='<div class="mth"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20.38 3.46L16 2a4 4 0 0 1-8 0L3.62 3.46a2 2 0 0 0-1.34 2.23l.58 3.57a1 1 0 0 0 .99.84H6v10a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V10h2.15a1 1 0 0 0 .99-.84l.58-3.57a2 2 0 0 0-1.34-2.23z"/></svg></div>';
    html+='<div class="mi"><div class="mnrow"><span class="mname">'+m.name+'</span>'+(visibleCols.type_badge?'<span class="mbadge '+bcls+'">'+blbl+'</span>':'')+' </div>';
    var vname=(m.vendors&&m.vendors.length)?m.vendors[0].name+(m.vendors.length>1?' +'+( m.vendors.length-1):''):'No vendor';
    var subparts=[];
    if(visibleCols.varcount)subparts.push(m.variants.length+' variant'+(m.variants.length!==1?'s':''));
    if(visibleCols.vendor)subparts.push(vname);
    html+='<div class="msub">'+subparts.join(' · ')+'</div>';
    if(visibleCols.sku)html+='<div class="msku">'+m.sku+'</div>'; html+='</div>';
    if(visibleCols.qty){html+='<div class="mqw"><div class="mqty '+qc+'">'+tq+'</div><div class="mqty-l">'+(visibleCols.value?'Rs.'+m.variants.reduce(function(a,v){return a+(v.qty||0)*(v.cost||0);},0).toLocaleString('en-IN'):'in stock')+'</div></div>';}
    var inCols=collections.filter(function(col){return col.manualIds.includes(m.id)||(m.tags&&m.tags.some(function(t){return col.tagRules.includes(t);}));}).length;
    if(visibleCols.collection_btn)html+='<div onclick="event.stopPropagation();openAddToCol('+m.id+')" title="Add to collection" style="display:flex;align-items:center;justify-content:center;width:26px;height:26px;border-radius:50%;cursor:pointer;flex-shrink:0;color:'+(inCols?'var(--p)':'var(--tx3)')+';position:relative;" onmouseenter="this.style.background=\'var(--sf2)\'" onmouseleave="this.style.background=\'\'">'+
      '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/><line x1="12" y1="12" x2="12" y2="16"/><line x1="10" y1="14" x2="14" y2="14"/></svg>'+
      (inCols?'<span style="position:absolute;top:-2px;right:-2px;width:8px;height:8px;border-radius:50%;background:var(--p);border:1.5px solid var(--sf);"></span>':'')+'</div>';
    html+='<div class="mexp'+(exp?' open':'')+'" id="mexp-'+m.id+'" onclick="event.stopPropagation();toggleMat('+m.id+')" title="'+(exp?'Collapse':'Expand')+' '+m.variants.length+' variant'+(m.variants.length!==1?'s':'')+'"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 18l6-6-6-6"/></svg></div></div>';
    if(exp){
      html+='<div class="vlist">';
      m.variants.forEach(function(v,vi){
        var vqc=(parseInt(v.qty)||0)===0?'lo':'ok';
        html+='<div class="vrow" onclick="openEditMat('+m.id+','+vi+')"><div class="vi-in"><div class="vi-ln"></div></div><div class="vi-cn"></div>';
        html+='<div class="vi-inner"><div class="vidw"><div class="vdot" style="background:'+(v.color||'#4A3BB5')+'"></div></div>';
        html+='<div class="viinf"><div class="viname">'+v.name+'</div><div class="visku">'+v.sku+'</div></div>';
        html+='<div class="viqty '+vqc+'">'+(parseInt(v.qty)||0)+'</div><div class="viarr"><svg style="font-size:12px;" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 18l6-6-6-6"/></svg></div>';
        html+='</div></div>';
      });
      html+='</div>';
    }
    html+='</div>';
  });
  if(!pageData.length)html='<div style="padding:32px 16px;text-align:center;color:var(--tx3);font-size:13px;">No materials found</div>';

  // pagination bar
  if(totalPages>1){
    html+='<div style="display:flex;align-items:center;justify-content:center;gap:6px;padding:14px 12px 4px;">';
    // prev
    html+='<button onclick="goPage('+(curPage-1)+')" '+(curPage<=1?'disabled':'')+' style="width:32px;height:32px;border-radius:var(--rads);border:0.5px solid var(--br2);background:'+(curPage<=1?'var(--sf2)':'var(--sf)')+';color:'+(curPage<=1?'var(--tx3)':'var(--tx)')+';cursor:'+(curPage<=1?'default':'pointer')+';display:flex;align-items:center;justify-content:center;"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6"/></svg></button>';
    // page numbers
    var pages=[];
    for(var p=1;p<=totalPages;p++){
      if(p===1||p===totalPages||Math.abs(p-curPage)<=1)pages.push(p);
      else if(pages[pages.length-1]!=='…')pages.push('…');
    }
    pages.forEach(function(p){
      if(p==='…'){
        html+='<span style="font-size:13px;color:var(--tx3);padding:0 4px;">…</span>';
      } else {
        var active=p===curPage;
        html+='<button onclick="goPage('+p+')" style="min-width:32px;height:32px;border-radius:var(--rads);border:0.5px solid '+(active?'var(--p)':'var(--br2)')+';background:'+(active?'var(--p)':'var(--sf)')+';color:'+(active?'#fff':'var(--tx)')+';font-size:13px;font-weight:'+(active?'500':'400')+';cursor:pointer;padding:0 6px;">'+p+'</button>';
      }
    });
    // next
    html+='<button onclick="goPage('+(curPage+1)+')" '+(curPage>=totalPages?'disabled':'')+' style="width:32px;height:32px;border-radius:var(--rads);border:0.5px solid var(--br2);background:'+(curPage>=totalPages?'var(--sf2)':'var(--sf)')+';color:'+(curPage>=totalPages?'var(--tx3)':'var(--tx)')+';cursor:'+(curPage>=totalPages?'default':'pointer')+';display:flex;align-items:center;justify-content:center;"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18l6-6-6-6"/></svg></button>';
    html+='</div>';
    html+='<div style="text-align:center;padding:4px 12px 14px;font-size:11px;color:var(--tx3);">Page '+curPage+' of '+totalPages+' · '+total+' results</div>';
  }

  document.getElementById('mat-list').innerHTML=html;
}
function goPage(p){
  var data=applyF(materials);
  var totalPages=Math.max(1,Math.ceil(data.length/PAGE_SIZE));
  curPage=Math.max(1,Math.min(totalPages,p));
  renderList();
  document.getElementById('mat-list').scrollIntoView({behavior:'smooth',block:'start'});
}
function toggleMat(id){expandedIds[id]=!expandedIds[id];renderList();}
function searchList(q){searchQ=q;curPage=1;renderList();}
function applyF(data){
  var d=data.slice();
  if(searchQ){var q=searchQ.toLowerCase();d=d.filter(function(m){return m.name.toLowerCase().includes(q)||m.sku.toLowerCase().includes(q)||m.variants.some(function(v){return v.name.toLowerCase().includes(q)||v.sku.toLowerCase().includes(q);});});}
  if(activeF.types.length)d=d.filter(function(m){return activeF.types.includes(m.type);});
  if(activeF.vendors.length)d=d.filter(function(m){var vnames=(m.vendors&&m.vendors.length)?m.vendors.map(function(v){return v.name;}):['Unassigned'];return activeF.vendors.some(function(fv){return vnames.includes(fv);});});
  if(activeF.qmode){
    d=d.filter(function(m){
      var tq=m.variants.reduce(function(s,v){return s+(parseInt(v.qty)||0);},0);
      if(activeF.qmode==='lt'&&activeF.qval!==null)return tq<activeF.qval;
      if(activeF.qmode==='gt'&&activeF.qval!==null)return tq>activeF.qval;
      if(activeF.qmode==='rng')return(activeF.qmin===null||tq>=activeF.qmin)&&(activeF.qmax===null||tq<=activeF.qmax);
      return true;
    });
  }
  if(activeF.varcount==='single')d=d.filter(function(m){return m.variants.length===1;});
  if(activeF.varcount==='multi')d=d.filter(function(m){return m.variants.length>1;});
  if(activeF.flags.includes('nosku'))d=d.filter(function(m){return m.variants.some(function(v){return !v.sku;});});
  if(activeF.flags.includes('nobarcode'))d=d.filter(function(m){return m.variants.some(function(v){return !v.barcode;});});
  if(activeF.flags.includes('noimg'))d=d.filter(function(m){return !m.imgs||!m.imgs.length;});
  if(activeF.flags.includes('noprice'))d=d.filter(function(m){return m.variants.some(function(v){return !v.offer;});});
  if(activeF.sort==='name')d.sort(function(a,b){return a.name.localeCompare(b.name);});
  else if(activeF.sort==='qty-lo')d.sort(function(a,b){return a.variants.reduce(function(s,v){return s+(parseInt(v.qty)||0);},0)-b.variants.reduce(function(s,v){return s+(parseInt(v.qty)||0);},0);});
  else if(activeF.sort==='qty-hi')d.sort(function(a,b){return b.variants.reduce(function(s,v){return s+(parseInt(v.qty)||0);},0)-a.variants.reduce(function(s,v){return s+(parseInt(v.qty)||0);},0);});
  else if(activeF.sort==='new')d.sort(function(a,b){return b.id-a.id;});
  else if(activeF.sort==='vars')d.sort(function(a,b){return b.variants.length-a.variants.length;});
  return d;
}
function toggleFilterPanel(){
  var p=document.getElementById('filter-panel');
  var open=p.style.display==='none'?'block':'none';
  p.style.display=open;
  document.getElementById('filt-btn').classList.toggle('act',open==='block');
}
var _fpOpen={};
function toggleFPGroup(grp){
  var body=document.getElementById('fpb-'+grp);
  var arr=document.getElementById('fpa-'+grp);
  var open=body.style.display==='none';
  body.style.display=open?'block':'none';
  if(arr)arr.classList.toggle('open',open);
}
function updateFPBadge(grp){
  var el=document.getElementById('fpv-'+grp);if(!el)return;
  if(grp==='qty'){
    if(!activeF.qmode){el.textContent='Any';el.className='fp-val muted';}
    else if(activeF.qmode==='lt'&&activeF.qval!=null){el.textContent='< '+activeF.qval;el.className='fp-val';}
    else if(activeF.qmode==='gt'&&activeF.qval!=null){el.textContent='> '+activeF.qval;el.className='fp-val';}
    else if(activeF.qmode==='rng'){var lo=activeF.qmin!=null?activeF.qmin:'—';var hi=activeF.qmax!=null?activeF.qmax:'—';el.textContent=lo+'–'+hi;el.className='fp-val';}
    else{el.textContent='Any';el.className='fp-val muted';}
  } else if(grp==='type'){
    el.textContent=activeF.types.length?activeF.types.map(function(t){return{finished:'Finished',raw:'Raw',production:'Production'}[t]||t;}).join(', '):'Any';
    el.className=activeF.types.length?'fp-val':'fp-val muted';
  } else if(grp==='vendor'){
    el.textContent=activeF.vendors.length?activeF.vendors.join(', '):'Any';
    el.className=activeF.vendors.length?'fp-val':'fp-val muted';
  } else if(grp==='varcount'){
    el.textContent=!activeF.varcount?'Any':activeF.varcount==='single'?'Single only':'Multiple';
    el.className=activeF.varcount?'fp-val':'fp-val muted';
  }
}
function setQtyModeInline(mode){
  activeF.qmode=mode;activeF.qval=null;activeF.qmin=null;activeF.qmax=null;
  var rng=document.getElementById('qty-inputs-inline');
  var val=document.getElementById('qty-val-inline');
  var fqmin=document.getElementById('fq-min'),fqmax=document.getElementById('fq-max'),fqval=document.getElementById('fq-val');
  if(rng)rng.style.display='none';if(val)val.style.display='none';
  if(fqmin)fqmin.value='';if(fqmax)fqmax.value='';if(fqval)fqval.value='';
  if(mode==='rng'&&rng)rng.style.display='flex';
  else if((mode==='lt'||mode==='gt')&&val)val.style.display='block';
  updateFPBadge('qty');renderList();renderAFBar();
}
function toggleFPCheck(grp,val,checked){
  var arr=grp==='type'?activeF.types:activeF.vendors;
  var i=arr.indexOf(val);
  if(checked&&i===-1)arr.push(val);else if(!checked&&i>-1)arr.splice(i,1);
  curPage=1;updateFPBadge(grp);renderList();renderAFBar();
}
function setFPVarcount(val){
  activeF.varcount=val;curPage=1;updateFPBadge('varcount');renderList();renderAFBar();
}
function setFPSort(val,label){
  activeF.sort=val;
  var el=document.getElementById('fpv-sort');
  if(el){el.textContent=label;el.className=val==='name'?'fp-val muted':'fp-val';}
  renderList();
}
function setSort(el,s){activeF.sort=s;renderList();}
function toggleFChip(el,key,cls){
  if(key==='single'||key==='multi'){var already=activeF.varcount===key;activeF.varcount=already?'':key;updateFPBadge('varcount');}
  else{var fi=activeF.flags.indexOf(key);if(fi>-1)activeF.flags.splice(fi,1);else activeF.flags.push(key);}
}
function toggleMultiChip(el,grp,val){
  var arr=grp==='type'?activeF.types:activeF.vendors;
  var i=arr.indexOf(val);if(i>-1)arr.splice(i,1);else arr.push(val);
  updateFPBadge(grp);
}
function setQtyMode(mode){setQtyModeInline(mode);}
function clearFilters(){
  activeF={qmode:'',qval:null,qmin:null,qmax:null,types:[],vendors:[],varcount:'',flags:[],sort:'name'};
  ['fc-finished','fc-raw','fc-production','fc-v1','fc-v2','fc-v3','fc-v4'].forEach(function(id){var e=document.getElementById(id);if(e)e.checked=false;});
  document.querySelectorAll('input[name="qmode"]').forEach(function(r){r.checked=r.value==='';});
  document.querySelectorAll('input[name="varcount"]').forEach(function(r){r.checked=r.value==='';});
  document.querySelectorAll('input[name="sortby"]').forEach(function(r){r.checked=r.value==='name';});
  ['fq-min','fq-max','fq-val'].forEach(function(id){var e=document.getElementById(id);if(e)e.value='';});
  var ri=document.getElementById('qty-inputs-inline'),rv=document.getElementById('qty-val-inline');
  if(ri)ri.style.display='none';if(rv)rv.style.display='none';
  ['qty','type','vendor','varcount'].forEach(function(g){updateFPBadge(g);});
  var sv=document.getElementById('fpv-sort');if(sv){sv.textContent='Name A–Z';sv.className='fp-val muted';}
  renderList();renderAFBar();
}
function applyFilters(){
  curPage=1;
  var p=document.getElementById('filter-panel');if(p)p.style.display='none';
  document.getElementById('filt-btn').classList.remove('act');
  renderList();renderAFBar();
}
function renderAFBar(){
  var chips=[];
  if(activeF.qmode==='lt'&&activeF.qval!==null)chips.push({cls:'purple',label:'Qty < '+activeF.qval});
  else if(activeF.qmode==='gt'&&activeF.qval!==null)chips.push({cls:'purple',label:'Qty > '+activeF.qval});
  else if(activeF.qmode==='rng'){
    var lo=activeF.qmin!==null?activeF.qmin:'—';var hi=activeF.qmax!==null?activeF.qmax:'—';
    chips.push({cls:'purple',label:'Qty '+lo+'–'+hi});
  }
  activeF.types.forEach(function(t){chips.push({cls:'purple',label:{finished:'Finished goods',raw:'Raw material',production:'Production'}[t]||t});});
  activeF.vendors.forEach(function(v){chips.push({cls:'amber',label:v});});
  if(activeF.varcount==='single')chips.push({cls:'purple',label:'Single variant'});
  if(activeF.varcount==='multi')chips.push({cls:'purple',label:'Multi variant'});
  activeF.flags.forEach(function(f){chips.push({cls:'amber',label:{nosku:'Missing SKU',nobarcode:'Missing barcode',noimg:'No image',noprice:'No price'}[f]||f});});
  var bar=document.getElementById('af-bar');
  bar.style.display=chips.length?'flex':'none';
  bar.innerHTML=chips.map(function(c){return '<div class="afc '+c.cls+'">'+c.label+' <svg style="font-size:10px;" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M18 6L6 18M6 6l12 12"/></svg></div>';}).join('');
  var cnt=(activeF.qmode?1:0)+activeF.types.length+activeF.vendors.length+(activeF.varcount?1:0)+activeF.flags.length;
  var fb=document.getElementById('filt-btn');var fl=document.getElementById('filt-lbl');
  if(cnt){fb.classList.add('act');fl.textContent='Filter · '+cnt;}else{fb.classList.remove('act');fl.textContent='Filter';}
}

// ═══════════════════════════════
//  CREATE / EDIT
// ═══════════════════════════════
function openCreate(){
  editingId=null;
  editMat={name:'',type:'finished',sku:'',design:'',vendors:[],unit:'Inches (in)',desc:'',notes:'',techpack:'',imgs:[],
    cats:[],variants:[]};
  uploadedImgs=[];
  document.getElementById('create-title').textContent='New material';
  setCTab(0);buildCreatePages();
  pushScreen('create');
}
function openEditMat(mid,vidx){
  editingId=mid;
  var m=materials.find(function(x){return x.id===mid;});
  editMat=JSON.parse(JSON.stringify(m));
  uploadedImgs=editMat.imgs.slice();
  document.getElementById('create-title').textContent='Edit material';
  setCTab(0);buildCreatePages();
  if(vidx!==undefined){setTimeout(function(){openVarDetail(vidx);},100);}
  pushScreen('create');
}
function setCTab(n){
  curCTab=n;
  [0,1,2].forEach(function(i){
    var t=document.getElementById('ctab-'+i);
    if(t)t.classList.toggle('on',i===n);
    var p=document.getElementById('cpg-'+i);
    if(p)p.style.display=i===n?'block':'none';
  });
}
function buildCreatePages(){
  document.getElementById('cpg-0').innerHTML=buildInfoHTML();
  document.getElementById('cpg-1').innerHTML=buildMovementHTML();
  document.getElementById('cpg-2').innerHTML=buildSupplyHTML();
}

function buildInfoHTML(){
  var m=editMat;

  // ── variant categories ──
  var catHTML='';
  (m.cats||[]).forEach(function(cat,ci){
    var hasSets=optionSets.some(function(s){return s.cat.toLowerCase()===cat.name.toLowerCase();});
    catHTML+='<div class="opt-card"><div class="opt-cat-row">'+
      '<svg style="color:var(--tx3);" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 5a1 1 0 1 0 0-2 1 1 0 0 0 0 2zM9 13a1 1 0 1 0 0-2 1 1 0 0 0 0 2zM9 21a1 1 0 1 0 0-2 1 1 0 0 0 0 2zM15 5a1 1 0 1 0 0-2 1 1 0 0 0 0 2zM15 13a1 1 0 1 0 0-2 1 1 0 0 0 0 2zM15 21a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/></svg>'+
      '<span class="opt-cat-name">'+esc(cat.name)+'</span>'+
      '<span class="opt-cat-count">'+cat.values.length+' value'+(cat.values.length!==1?'s':'')+'</span>'+
      (hasSets?'<button id="preset-btn-'+ci+'" onclick="togglePresetDropdown('+ci+')" style="display:inline-flex;align-items:center;gap:3px;padding:3px 8px;border-radius:20px;background:var(--pl);border:0.5px solid var(--pm);color:var(--pt);font-size:11px;font-weight:500;cursor:pointer;font-family:inherit;white-space:nowrap;flex-shrink:0;"><svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"/></svg> Presets <svg id="preset-arr-'+ci+'" width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="transition:transform 0.2s;"><path d="M6 9l6 6 6-6"/></svg></button>':'')+
      '<span class="opt-cat-del" onclick="deleteCat('+ci+')" style="display:inline-flex;align-items:center;cursor:pointer;color:var(--tx3);flex-shrink:0;">'+ico('trash',16)+'</span>'+
    '</div>'+
    (hasSets?'<div id="preset-dd-'+ci+'" style="display:none;background:var(--sf2);border-top:0.5px solid var(--br);">'+buildPresetDropdownHTML(ci,cat)+'</div>':'')+
    '<div class="opt-values"><div class="val-chips">';
    cat.values.forEach(function(v,vi){
      catHTML+='<span class="val-chip '+cat.style+'">'+esc(v)+
        '<span class="val-del" onclick="delVal('+ci+','+vi+')" aria-label="Remove">×</span></span>';
    });
    catHTML+='</div>'+
    '<div class="add-val-row">'+
      '<input class="add-val-inp" id="vi-'+ci+'" type="text" placeholder="Add value…" onkeydown="if(event.key===\'Enter\')addVal('+ci+')"/>'+
      '<button class="add-val-btn" onclick="addVal('+ci+')">Add</button>'+
    '</div></div></div>';
  });

  // ── variant matrix ──
  var combos=getCombos();
  var vmHTML='';
  (m.variants||[]).forEach(function(v,vi){
    vmHTML+='<div class="vm-item">'+
      '<div class="vm-top">'+
        '<div class="vm-img" onclick="openVarImgSheet('+vi+')">'+
          (v.images&&v.images.length?'<div class="vm-img-f"><img src="'+v.images[0]+'" alt=""/></div>':'<div class="vm-img-e"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h3l2-2h4l2 2h3a2 2 0 0 1 2 2zM12 17a4 4 0 1 0 0-8 4 4 0 0 0 0 8z"/></svg></div>')+
          '<div class="vm-img-plus"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 5v14M5 12h14"/></svg></div>'+
        '</div>'+
        '<div class="vm-main">'+
          '<div class="vm-tags">'+
            (v.tags||[]).map(function(t){return '<span class="vm-tag '+t.style+'">'+esc(t.label)+'</span>';}).join('')+
            '<span style="font-size:12px;color:var(--p);cursor:pointer;" onclick="openTagSheet('+vi+')">+ Tag</span>'+
          '</div>'+
          '<input class="vm-sku-inp" type="text" placeholder="SKU…" value="'+esc(v.sku||'')+'" oninput="editMat.variants['+vi+'].sku=this.value"/>'+
        '</div>'+
        '<div class="vm-right">'+
          '<div class="stp"><button class="stb" onclick="adjVQ('+vi+',-1)">−</button><input class="stv" id="vmq-'+vi+'" type="text" value="'+(parseInt(v.qty)||0)+'" oninput="editMat.variants['+vi+'].qty=parseInt(this.value)||0"/><button class="stb" onclick="adjVQ('+vi+',1)">+</button></div>'+
          '<div class="vm-detail-link" onclick="openVarDetail('+vi+')">Details <svg style="font-size:11px;" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 18l6-6-6-6"/></svg></div>'+
        '</div>'+
      '</div>'+
      '<div class="vm-price-grid">'+
        '<div class="vpc"><div class="vpc-lbl">MRP</div><div class="vpc-row"><span class="vpc-pre">Rs.</span><input class="vpc-inp" type="text" placeholder="0" value="'+(v.mrp||'')+'" oninput="editMat.variants['+vi+'].mrp=parseFloat(this.value)||0"/></div></div>'+
        '<div class="vpc"><div class="vpc-lbl">Offer price</div><div class="vpc-row"><span class="vpc-pre">Rs.</span><input class="vpc-inp offer" type="text" placeholder="0" value="'+(v.offer||'')+'" oninput="editMat.variants['+vi+'].offer=parseFloat(this.value)||0"/></div></div>'+
        '<div class="vpc"><div class="vpc-lbl">Cost</div><div class="vpc-row"><span class="vpc-pre">Rs.</span><input class="vpc-inp" type="text" placeholder="0" value="'+(v.cost||'')+'" oninput="editMat.variants['+vi+'].cost=parseFloat(this.value)||0"/></div></div>'+
      '</div>'+
      '<div class="bc-row"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 7v10M8 7v10M12 7v10M16 7v10M20 7v10M6 7v10M10 7v10M14 7v10M18 7v10"/></svg>'+
        '<input class="bc-inp" id="bci-'+vi+'" type="text" placeholder="Barcode…" value="'+esc(v.barcode||'')+'" oninput="editMat.variants['+vi+'].barcode=this.value"/>'+
        '<span class="bc-gen-btn" onclick="genBarcode('+vi+')">Generate</span>'+
      '</div>'+
    '</div>';
  });

  return '<div class="sec" style="margin-top:10px;">'+
    '<div class="sec-hdr" style="border-bottom:none;"><span class="sec-title">Basic info</span></div>'+
    '<div class="f"><div class="lbl">Product title *</div><input class="inp" id="f-title" type="text" placeholder="e.g. Blue Offshoulder Chatri Aakaar" value="'+esc(m.name)+'"/></div>'+
    '<div class="f2"><div><div class="lbl">SKU</div><input class="inp" id="f-sku" type="text" placeholder="MTOCA-BLUE-XS" value="'+esc(m.sku)+'"/></div><div><div class="lbl">Design no.</div><input class="inp" id="f-design" type="text" placeholder="Optional" value="'+esc(m.design||'')+'"/></div></div>'+
    '<div class="f2"><div><div class="lbl">Material type</div><select class="inp" id="f-type"><option value="finished"'+(m.type==='finished'?' selected':'')+'>Finished good</option><option value="raw"'+(m.type==='raw'?' selected':'')+'>Raw material</option><option value="production"'+(m.type==='production'?' selected':'')+'>Production</option></select></div>'+
    '<div><div class="lbl">Unit</div><select class="inp" id="f-unit"><option>Inches (in)</option><option>Metres (m)</option><option>Pieces</option><option>Kilograms</option></select></div></div>'+
  '</div>'+

  '<div class="sec">'+
    '<div class="sec-hdr"><span class="sec-title">Description</span><div class="cred"><div class="cred-dot"></div>12 credits</div></div>'+
    '<div class="desc-box" style="margin-top:10px;">'+
      '<textarea class="desc-ta" id="f-desc" rows="3" placeholder="Short product description…" oninput="upChars()">'+esc(m.desc||'')+'</textarea>'+
      '<div class="desc-bar"><span class="desc-chars" id="desc-chars">'+(m.desc||'').length+' chars</span>'+
      '<div class="ai-btn" onclick="triggerAI()"><svg style="font-size:12px;" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 3l2 5h5l-4 3 1.5 5L12 13l-4.5 3L9 11 5 8h5l2-5zM5 19l1 2 2-1-1 2-2 1 1-2-2-1 2-1zM20 6l.5 1.5L22 8l-1.5.5L20 10l-.5-1.5L18 8l1.5-.5L20 6z"/></svg>Write with AI</div></div>'+
    '</div>'+
    '<div class="ai-gen" id="ai-gen" style="display:none;">'+
      '<div class="ai-gen-top"><svg style="font-size:13px;color:#534AB7;" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 3l2 5h5l-4 3 1.5 5L12 13l-4.5 3L9 11 5 8h5l2-5zM5 19l1 2 2-1-1 2-2 1 1-2-2-1 2-1zM20 6l.5 1.5L22 8l-1.5.5L20 10l-.5-1.5L18 8l1.5-.5L20 6z"/></svg><span style="font-size:12px;font-weight:500;color:var(--pt);flex:1;">AI suggestion</span><span style="font-size:11px;color:#7F77DD;">1 credit used</span></div>'+
      '<div class="ai-gen-text" id="ai-gen-text"></div>'+
      '<div class="ai-gen-acts"><button class="ai-retry" onclick="triggerAI()">Retry</button><button class="ai-use" onclick="useAI()">Use this</button></div>'+
    '</div>'+
  '</div>'+

  '<div class="sec">'+
    '<div class="sec-hdr"><span class="sec-title">Product images</span></div>'+
    '<div class="img-previews" id="img-previews" style="padding-top:10px;"></div>'+
    '<div class="img-zone" onclick="document.getElementById(\'img-inp\').click()">'+
      '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 15V8a2 2 0 0 0-2-2h-3l-2-2h-4L8 6H5a2 2 0 0 0-2 2v11a2 2 0 0 0 2 2h7M16 19l3-3 3 3M19 16v6"/></svg>'+
      '<div class="img-zone-lbl">Upload images</div><div class="img-zone-sub">JPEG, PNG · Max 5MB</div>'+
    '</div><input type="file" id="img-inp" accept="image/*" multiple onchange="handleImgs(this)"/>'+
    '<div class="f last"><div class="lbl">Tags</div><input class="inp" id="f-tags" type="text" placeholder="Comma separated tags…" value="'+esc((m.tags||[]).join(', '))+'"/></div>'+
  '</div>'+

  '<div class="sec">'+
    '<div class="sec-hdr"><span class="sec-title">Variant categories</span></div>'+
    '<div class="cat-sugs">'+
      '<div class="cat-sug" onclick="quickAddCat(\'Size\')"><svg style="font-size:13px;" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5zM8 5v3M12 5v5M16 5v3"/></svg> Size</div>'+
      '<div class="cat-sug" onclick="quickAddCat(\'Color\')"><svg style="font-size:13px;" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 2a10 10 0 0 0 0 20c.6 0 1-.4 1-1v-1c0-.5.5-1 1-1h3c2.8 0 5-2.2 5-5 0-5.5-4.5-12-10-12zM7.5 13a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zM9.5 9a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zM14.5 9a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/></svg> Color</div>'+
      '<div class="cat-sug" onclick="quickAddCat(\'Material\')"><svg style="font-size:13px;" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20.38 3.46L16 2a4 4 0 0 1-8 0L3.62 3.46a2 2 0 0 0-1.34 2.23l.58 3.57a1 1 0 0 0 .99.84H6v10a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V10h2.15a1 1 0 0 0 .99-.84l.58-3.57a2 2 0 0 0-1.34-2.23z"/></svg> Material</div>'+
      '<div class="cat-sug" onclick="quickAddCat(\'Pattern\')"><svg style="font-size:13px;" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 4h2v2H4zM10 4h2v2h-2zM16 4h2v2h-2zM4 10h2v2H4zM10 10h2v2h-2zM16 10h2v2h-2zM4 16h2v2H4zM10 16h2v2h-2zM16 16h2v2h-2z"/></svg> Pattern</div>'+
      '<div class="cat-sug" style="color:var(--tx3);border-style:dashed;" onclick="goSettings()"><svg style="font-size:13px;" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 20a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm0-5a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/></svg> Sets</div>'+
    '</div>'+
    '<div id="opt-list">'+catHTML+'</div>'+
    '<div class="add-cat-row">'+
      '<input class="add-cat-inp" id="new-cat-inp" type="text" placeholder="Add variant category, e.g. Length…" onkeydown="if(event.key===\'Enter\')addCat()"/>'+
      '<button class="add-cat-btn" onclick="addCat()">Add</button>'+
    '</div>'+
  '</div>'+

  '<button class="gen-btn" onclick="generateVariants()">'+
    '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 3l2 5h5l-4 3 1.5 5L12 13l-4.5 3L9 11 5 8h5l2-5zM5 19l1 2 2-1-1 2-2 1 1-2-2-1 2-1zM20 6l.5 1.5L22 8l-1.5.5L20 10l-.5-1.5L18 8l1.5-.5L20 6z"/></svg> Generate <span id="gen-badge" class="gen-badge">'+combos+'</span> variant combinations'+
  '</button>'+

  (m.variants&&m.variants.length?
    '<div class="apply-banner">'+
      '<div class="apply-icon"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M8 4H6a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-4-4H8v4h8M8 12h8M8 16h4"/></svg></div>'+
      '<div class="apply-text"><div class="apply-title">Apply to all variants</div><div class="apply-sub">Copy pricing, images or inventory</div></div>'+
      '<button class="apply-btn" onclick="openSheet(\'sh-bulk\')">Apply</button>'+
    '</div>'+
    '<div style="padding:10px 12px 4px;display:flex;align-items:center;justify-content:space-between;">'+
      '<span style="font-size:13px;font-weight:500;color:var(--tx);">Variants ('+m.variants.length+')</span>'+
    '</div>'+
    vmHTML
  :'<div style="padding:20px 16px;text-align:center;font-size:13px;color:var(--tx3);">Define variant categories above, then tap Generate.</div>')+

  '<div class="sec" style="margin-top:10px;margin-bottom:10px;">'+
    '<div class="sec-hdr"><span class="sec-title">Notes</span></div>'+
    '<div class="f last"><textarea class="inp" id="f-notes" rows="2" placeholder="Internal notes…">'+esc(m.notes||'')+'</textarea></div>'+
  '</div>';
}



function buildMovementHTML(){
  // ── sample time-series: inventory value = qty × avg cost over 16 weeks ──
  var periods=[
    {label:'Jun W1', qty:18, val:50400},
    {label:'Jun W2', qty:22, val:61600},
    {label:'Jun W3', qty:16, val:44800},
    {label:'Jun W4', qty:24, val:67200},
    {label:'Jul W1', qty:20, val:56000},
    {label:'Jul W2', qty:28, val:78400},
    {label:'Jul W3', qty:14, val:39200},
    {label:'Jul W4', qty:30, val:84000},
    {label:'Aug W1', qty:25, val:70000},
    {label:'Aug W2', qty:18, val:50400},
    {label:'Aug W3', qty:32, val:89600},
    {label:'Aug W4', qty:22, val:61600},
    {label:'Sep W1', qty:27, val:75600},
    {label:'Sep W2', qty:19, val:53200},
    {label:'Sep W3', qty:14, val:39200},
    {label:'Sep W4', qty:17, val:47600},
  ];

  var W=340,H=120,PL=42,PR=10,PT=12,PB=24;
  var chartW=W-PL-PR, chartH=H-PT-PB;
  var n=periods.length;
  var vals=periods.map(function(p){return p.val;});
  var maxV=Math.max.apply(null,vals);
  var minV=Math.min.apply(null,vals);
  var vRange=maxV-minV||1;
  var stepX=chartW/(n-1);

  function px(i){ return (PL+i*stepX).toFixed(1); }
  function py(v){ return (PT+chartH-(v-minV)/vRange*chartH).toFixed(1); }

  // polyline points
  var polyPts=periods.map(function(p,i){return px(i)+','+py(p.val);}).join(' ');
  // area path
  var areaPath='M'+px(0)+','+py(periods[0].val)+
    periods.slice(1).map(function(p,i){return ' L'+px(i+1)+','+py(p.val);}).join('')+
    ' L'+px(n-1)+','+(PT+chartH)+' L'+PL+','+(PT+chartH)+' Z';

  // y-axis grid lines (3 levels)
  var yTicks=[minV, Math.round((minV+maxV)/2), maxV];
  var gridLines=yTicks.map(function(t){
    var y=py(t);
    var lbl=t>=1000?(t/1000).toFixed(0)+'k':t;
    return '<line x1="'+PL+'" y1="'+y+'" x2="'+(W-PR)+'" y2="'+y+'" stroke="var(--br)" stroke-width="0.5" stroke-dasharray="3,3"/>'+
      '<text x="'+(PL-4)+'" y="'+(parseFloat(y)+3.5)+'" font-size="8" fill="var(--tx3)" text-anchor="end" font-family="system-ui,sans-serif">'+lbl+'</text>';
  }).join('');

  // x-axis: show every 4th label
  var xLabels=periods.map(function(p,i){
    if(i%4!==0&&i!==n-1)return'';
    return '<text x="'+px(i)+'" y="'+(H-4)+'" font-size="8" fill="var(--tx3)" text-anchor="middle" font-family="system-ui,sans-serif">'+p.label+'</text>';
  }).join('');

  // highlight dot at current (last) point
  var cx=px(n-1),cy=py(periods[n-1].val);
  var curVal=periods[n-1].val;
  var curQty=periods[n-1].qty;

  // trend: compare last vs first
  var trend=curVal>periods[0].val?'up':curVal<periods[0].val?'down':'flat';
  var trendPct=Math.round(Math.abs(curVal-periods[0].val)/periods[0].val*100);
  var trendColor=trend==='up'?'var(--g)':trend==='down'?'var(--r)':'var(--tx2)';
  var trendLabel=trend==='up'?'▲ +'+trendPct+'% vs 16 weeks ago':trend==='down'?'▼ −'+trendPct+'% vs 16 weeks ago':'Flat vs 16 weeks ago';

  var chartSVG=
    '<svg viewBox="0 0 '+W+' '+H+'" width="100%" xmlns="http://www.w3.org/2000/svg" style="display:block;overflow:visible;">'+
      '<defs>'+
        '<linearGradient id="mvgrad" x1="0" y1="0" x2="0" y2="1">'+
          '<stop offset="0%" stop-color="#4A3BB5" stop-opacity="0.18"/>'+
          '<stop offset="100%" stop-color="#4A3BB5" stop-opacity="0.02"/>'+
        '</linearGradient>'+
      '</defs>'+
      gridLines+
      '<path d="'+areaPath+'" fill="url(#mvgrad)"/>'+
      '<polyline points="'+polyPts+'" fill="none" stroke="#4A3BB5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>'+
      xLabels+
      // highlight last point
      '<circle cx="'+cx+'" cy="'+cy+'" r="4" fill="#4A3BB5" stroke="#fff" stroke-width="1.5"/>'+
    '</svg>';

  var periodOpts=['Last 4 weeks','Last 8 weeks','Last 16 weeks','Last 6 months','Last 12 months'];

  return (
    // ── Value chart ──
    '<div class="sec" style="margin-top:10px;">'+
      '<div class="sec-hdr" style="align-items:flex-start;">'+
        '<div>'+
          '<div class="sec-title">Inventory value</div>'+
          '<div style="font-size:11px;color:var(--tx2);margin-top:2px;">Rs. per unit × qty in stock</div>'+
        '</div>'+
        '<select onchange="showToast(\'Chart period: \'+this.value)" style="font-size:11px;border:0.5px solid var(--br2);border-radius:6px;padding:4px 8px;background:var(--sf2);color:var(--tx2);outline:none;font-family:inherit;cursor:pointer;">'+
          periodOpts.map(function(o,i){return '<option'+(i===2?' selected':'')+'>'+o+'</option>';}).join('')+
        '</select>'+
      '</div>'+

      // stat row
      '<div style="display:flex;align-items:center;gap:16px;padding:8px 14px 10px;">'+
        '<div>'+
          '<div style="font-size:18px;font-weight:600;color:var(--p);">Rs. '+curVal.toLocaleString('en-IN')+'</div>'+
          '<div style="font-size:11px;color:var(--tx2);margin-top:1px;">Current value · '+curQty+' units</div>'+
        '</div>'+
        '<div style="font-size:12px;font-weight:500;color:'+trendColor+';margin-left:auto;">'+trendLabel+'</div>'+
      '</div>'+

      // chart
      '<div style="padding:0 12px 12px;">'+chartSVG+'</div>'+
    '</div>'+

    // ── Stats overview ──
    '<div class="sec" style="margin-top:10px;">'+
      '<div class="sec-hdr"><span class="sec-title">Movement overview</span></div>'+
      '<div style="display:grid;grid-template-columns:1fr 1fr;gap:7px;padding:10px 12px;">'+
        '<div class="inv-sc"><div class="inv-sc-l">Total in</div><div class="inv-sc-v ok">+24</div></div>'+
        '<div class="inv-sc"><div class="inv-sc-l">Total out</div><div class="inv-sc-v lo">−12</div></div>'+
        '<div class="inv-sc"><div class="inv-sc-l">Adjustments</div><div class="inv-sc-v">2</div></div>'+
        '<div class="inv-sc"><div class="inv-sc-l">Transfers</div><div class="inv-sc-v">0</div></div>'+
      '</div>'+
    '</div>'+

    // ── Recent movements ──
    '<div class="sec" style="margin-top:10px;margin-bottom:10px;">'+
      '<div class="sec-hdr"><span class="sec-title">Recent movements</span><span class="sec-act">+ Record</span></div>'+
      mvRow('out','23 Apr · 3:15 PM','Stock out','−2','SO-0131','14 → 12','Priya S.')+
      mvRow('in','18 Apr · 11:00 AM','Stock in','+12','PO-0341','2 → 14','Sabrang Textiles')+
      mvRow('adj','10 Apr · 6:00 PM','Adjustment','+2','—','0 → 2','Rahul M.')+
    '</div>'
  );
}
function mvRow(type,dt,label,delta,ref,bal,by){
  var bg={out:'var(--rl)',in:'var(--gl)',adj:'var(--al)'}[type]||'var(--sf2)';
  var tc={out:'var(--rt)',in:'var(--gt)',adj:'var(--at)'}[type]||'var(--tx)';
  return '<div style="display:flex;align-items:center;gap:10px;padding:10px 14px;border-bottom:0.5px solid var(--br);">'+
    '<div style="width:28px;height:28px;border-radius:50%;background:'+bg+';display:flex;align-items:center;justify-content:center;flex-shrink:0;color:'+tc+'">'+ico(type==='out'?'arrow-up':type==='in'?'arrow-down':'filter',14)+'</div>'+
    '<div style="flex:1;"><div style="font-size:12px;font-weight:500;color:'+tc+';">'+label+'</div><div style="font-size:11px;color:var(--tx2);">'+dt+' · '+ref+'</div></div>'+
    '<div style="text-align:right;"><div style="font-size:13px;font-weight:500;color:'+tc+';">'+delta+'</div><div style="font-size:10px;color:var(--tx3);">'+bal+'</div></div>'+
  '</div>';
}

function buildSupplyHTML(){
  var m=editMat;
  var vendors=m.vendors||[];

  // ── vendor rows ──
  var vendorRowsHTML=vendors.length?vendors.map(function(v,vi){
    return '<div style="padding:10px 14px;border-bottom:0.5px solid var(--br);display:flex;align-items:flex-start;gap:8px;" id="vrow-'+vi+'">'+
      '<div style="flex:1;min-width:0;">'+
        '<div style="display:grid;grid-template-columns:1fr 1fr;gap:7px;margin-bottom:7px;">'+
          '<input class="inp" type="text" placeholder="Vendor name" value="'+esc(v.name||'')+'" style="font-size:12px;padding:7px 9px;" oninput="editMat.vendors['+vi+'].name=this.value"/>'+
          '<select class="inp" style="font-size:12px;padding:7px 9px;" onchange="editMat.vendors['+vi+'].type=this.value">'+
            '<option value="primary"'+(v.type==='primary'?' selected':'')+'>Primary</option>'+
            '<option value="secondary"'+(v.type==='secondary'?' selected':'')+'>Secondary</option>'+
            '<option value="alternate"'+(v.type==='alternate'?' selected':'')+'>Alternate</option>'+
          '</select>'+
        '</div>'+
        '<div style="display:grid;grid-template-columns:1fr 1fr;gap:7px;">'+
          '<input class="inp" type="text" placeholder="Lead time (e.g. 7 days)" value="'+esc(v.lead||'')+'" style="font-size:12px;padding:7px 9px;" oninput="editMat.vendors['+vi+'].lead=this.value"/>'+
          '<input class="inp" type="tel" placeholder="Contact / phone" value="'+esc(v.contact||'')+'" style="font-size:12px;padding:7px 9px;" oninput="editMat.vendors['+vi+'].contact=this.value"/>'+
        '</div>'+
      '</div>'+
      '<button style="width:26px;height:26px;border-radius:50%;border:0.5px solid var(--br2);background:var(--sf2);cursor:pointer;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:2px;" onclick="removeVendor('+vi+')"><svg style="font-size:13px;color:var(--tx3);" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M18 6L6 18M6 6l12 12"/></svg></button>'+
    '</div>';
  }).join(''):'<div style="padding:14px 14px;font-size:13px;color:var(--tx3);"><svg style="font-size:15px;vertical-align:-2px;margin-right:6px;" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 21V9l9-6 9 6v12M9 21v-6h6v6M3 12h18"/></svg>No vendors added</div>';

  // ── production queue ──
  var queue=m.productionQueue||[
    {ref:'PO-0341',qty:50,status:'In progress',date:'28 Apr 2026',unit:'Asansol Factory'},
    {ref:'PO-0289',qty:30,status:'Completed',date:'10 Apr 2026',unit:'Asansol Factory'},
  ];
  var statusColor={
    'In progress':'background:var(--al);color:var(--at);',
    'Pending':'background:var(--bl);color:var(--bt);',
    'Completed':'background:var(--gl);color:var(--gt);',
  };
  var queueHTML=queue.map(function(q){
    var sc=statusColor[q.status]||'background:var(--sf2);color:var(--tx2);';
    return '<div style="display:flex;align-items:center;gap:9px;padding:10px 14px;border-bottom:0.5px solid var(--br);">'+
      '<div style="flex:1;min-width:0;">'+
        '<div style="font-size:13px;font-weight:500;color:var(--tx);">'+esc(q.ref)+'</div>'+
        '<div style="font-size:11px;color:var(--tx2);margin-top:2px;">'+esc(q.unit)+' · Due '+esc(q.date)+'</div>'+
      '</div>'+
      '<div style="text-align:right;flex-shrink:0;">'+
        '<div style="font-size:12px;font-weight:500;color:var(--tx);margin-bottom:4px;">'+q.qty+' pcs</div>'+
        '<span style="font-size:10px;padding:2px 7px;border-radius:20px;font-weight:500;'+sc+'">'+q.status+'</span>'+
      '</div>'+
    '</div>';
  }).join('');

  // ── techpack ──
  var TECHPACKS=[
    {name:'Blue Offshoulder — TP v3',meta:'Updated 23 Apr 2026'},
    {name:'Chatri Aakaar Base — TP v1',meta:'Updated 10 Jan 2026'},
    {name:'Umbrella Cut Dress — TP v2',meta:'Updated 5 Mar 2026'},
  ];
  var tpHTML=TECHPACKS.map(function(tp){
    return '<div class="tp-item" onclick="linkTP(\''+tp.name+'\')">'+
      '<div class="tp-ico" style="background:var(--pl);"><svg style="color:var(--p);" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8zM14 2v6h6M16 13H8M16 17H8M10 9H8"/></svg></div>'+
      '<div class="tp-info"><div class="tp-name">'+tp.name+'</div><div class="tp-meta">'+tp.meta+'</div></div>'+
      '<svg style="font-size:14px;color:var(--tx3);" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 18l6-6-6-6"/></svg>'+
    '</div>';
  }).join('');

  // ── material-level reservations (across all variants) ──
  var allReservations=[];
  (editMat.variants||[]).forEach(function(v){
    (v.reservations||[]).forEach(function(r){
      allReservations.push({varName:v.name,varSku:v.sku,order:r.order,customer:r.customer,qty:r.qty,status:r.status,date:r.date});
    });
  });
  var totalReserved=allReservations.reduce(function(s,r){return s+(parseInt(r.qty)||0);},0);
  var resHTML=allReservations.length?allReservations.map(function(r){
    var sc={confirmed:'background:var(--gl);color:var(--gt);',pending:'background:var(--al);color:var(--at);',partial:'background:var(--bl);color:var(--bt);'}[r.status]||'background:var(--sf2);color:var(--tx2);';
    return '<div style="display:flex;align-items:flex-start;gap:10px;padding:10px 14px;border-bottom:0.5px solid var(--br);">'+
      '<div style="flex:1;min-width:0;">'+
        '<div style="display:flex;align-items:center;gap:6px;flex-wrap:wrap;">'+
          '<span style="font-size:13px;font-weight:500;color:var(--tx);">'+esc(r.order)+'</span>'+
          '<span style="font-size:11px;padding:2px 8px;border-radius:20px;font-weight:500;'+sc+'">'+r.status.charAt(0).toUpperCase()+r.status.slice(1)+'</span>'+
        '</div>'+
        '<div style="font-size:11px;color:var(--tx2);margin-top:3px;">'+esc(r.customer)+' · '+esc(r.varName)+' · '+esc(r.date)+'</div>'+
        '<div style="font-size:10px;color:var(--tx3);font-family:monospace;margin-top:1px;">'+esc(r.varSku)+'</div>'+
      '</div>'+
      '<div style="text-align:right;flex-shrink:0;">'+
        '<div style="font-size:14px;font-weight:500;color:var(--p);">'+r.qty+' units</div>'+
      '</div>'+
    '</div>';
  }).join(''):'<div style="padding:16px 14px;text-align:center;font-size:13px;color:var(--tx3);">No reservations yet</div>';

  return '<div class="sec" style="margin-top:10px;">'+
    '<div class="sec-hdr"><span class="sec-title">Vendors</span><span class="sec-act" onclick="addVendor()"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 5v14M5 12h14"/></svg> Add vendor</span></div>'+
    '<div id="vendor-rows">'+vendorRowsHTML+'</div>'+
  '</div>'+

  '<div class="sec" style="margin-top:10px;">'+
    '<div class="sec-hdr"><span class="sec-title">Production queue</span><span class="sec-act" onclick="showToast(\'Opening production module…\')">View all →</span></div>'+
    (queue.length?queueHTML:'<div style="padding:14px;font-size:13px;color:var(--tx3);">No active production orders.</div>')+
    '<div style="padding:10px 14px;">'+
      '<button style="width:100%;padding:9px;border-radius:var(--rads);background:var(--sf2);border:0.5px dashed var(--br2);color:var(--p);font-size:12px;font-weight:500;cursor:pointer;font-family:inherit;" onclick="showToast(\'Opening production order creator…\')">'+
        '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 5v14M5 12h14"/></svg> Create production order'+
      '</button>'+
    '</div>'+
  '</div>'+

  '<div class="sec" style="margin-top:10px;">'+
    '<div class="sec-hdr">'+
      '<div>'+
        '<span class="sec-title">Reservations</span>'+
        (totalReserved?'<span style="font-size:11px;font-weight:500;color:var(--p);margin-left:7px;">'+totalReserved+' units reserved</span>':'') +
      '</div>'+
      '<button onclick="openSupplyReserveSheet()" style="display:inline-flex;align-items:center;gap:4px;padding:5px 10px;border-radius:6px;background:var(--pl);border:0.5px solid var(--pm);color:var(--pt);font-size:11px;font-weight:500;cursor:pointer;font-family:inherit;"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14M5 12h14"/></svg> Reserve</button>'+
    '</div>'+
    '<div id="supply-res-list">'+resHTML+'</div>'+
  '</div>'+

  '<div class="sec" style="margin-top:10px;">'+
    '<div class="sec-hdr" style="border-bottom:none;">'+
      '<div style="display:flex;align-items:center;gap:8px;">'+
        '<span class="sec-title">Costing</span>'+
        '<span id="costing-basis-badge" style="font-size:11px;padding:2px 9px;border-radius:20px;background:var(--sf2);border:0.5px solid var(--br2);color:var(--tx2);">'+(m.costingBasis==='order'?'Per Order':'Per Piece')+'</span>'+
      '</div>'+
      '<div style="display:flex;align-items:center;gap:6px;">'+
        '<span style="font-size:14px;font-weight:500;color:var(--p);" id="costing-total-badge">₹ '+calcSupplyTotal(m)+'</span>'+
        '<button onclick="toggleCostingExpand()" id="costing-expand-btn" style="width:26px;height:26px;border-radius:50%;background:var(--p);border:none;display:flex;align-items:center;justify-content:center;cursor:pointer;transition:transform 0.2s;"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 15l-6-6-6 6"/></svg></button>'+
      '</div>'+
    '</div>'+

    '<div id="costing-body">'+
      // Basis toggle
      '<div style="padding:10px 14px 12px;border-bottom:0.5px solid var(--br);">'+
        '<div style="font-size:13px;color:var(--tx2);margin-bottom:8px;">Costing basis:</div>'+
        '<div style="display:flex;gap:8px;">'+
          '<button id="cb-piece" onclick="setCostingBasis(\'piece\')" style="padding:8px 18px;border-radius:20px;font-size:13px;font-weight:500;cursor:pointer;border:0.5px solid var(--pm);font-family:inherit;background:'+((!m.costingBasis||m.costingBasis==='piece')?'var(--p)':'var(--sf2)')+';color:'+((!m.costingBasis||m.costingBasis==='piece')?'#fff':'var(--tx2)')+';">Per Piece</button>'+
          '<button id="cb-order" onclick="setCostingBasis(\'order\')" style="padding:8px 18px;border-radius:20px;font-size:13px;font-weight:500;cursor:pointer;border:0.5px solid var(--br2);font-family:inherit;background:'+(m.costingBasis==='order'?'var(--p)':'var(--sf2)')+';color:'+(m.costingBasis==='order'?'#fff':'var(--tx2)')+';">Per Order</button>'+
        '</div>'+
      '</div>'+

      // Material
      '<div style="padding:12px 14px 4px;border-bottom:0.5px solid var(--br);">'+
        '<div style="font-size:13px;font-weight:500;color:var(--tx);margin-bottom:8px;">Material</div>'+
        '<div style="display:grid;grid-template-columns:2fr 1fr 1.2fr 1.2fr 1.4fr 20px;gap:5px;margin-bottom:5px;">'+
          ['Material','Qty','Unit','Rate','Amount',''].map(function(h){return '<div style="font-size:10px;color:var(--tx3);">'+h+'</div>';}).join('')+
        '</div>'+
        '<div id="cost-materials">'+buildCostMaterialRows(m)+'</div>'+
        '<button onclick="addCostMaterial()" style="width:100%;padding:9px;margin-top:5px;margin-bottom:8px;border-radius:var(--rads);background:var(--sf2);border:0.5px solid var(--br2);color:var(--tx2);font-size:12px;cursor:pointer;font-family:inherit;">+ Add Material</button>'+
      '</div>'+

      // Jobwork
      '<div style="padding:12px 14px 4px;border-bottom:0.5px solid var(--br);">'+
        '<div style="font-size:13px;font-weight:500;color:var(--tx);margin-bottom:8px;">Jobwork</div>'+
        '<div id="cost-jobwork">'+buildCostJobRows(m)+'</div>'+
        '<button onclick="addCostJobwork()" style="width:100%;padding:9px;margin-top:5px;margin-bottom:8px;border-radius:var(--rads);background:var(--sf2);border:0.5px solid var(--br2);color:var(--tx2);font-size:12px;cursor:pointer;font-family:inherit;">+ Add Jobwork</button>'+
      '</div>'+

      // Other Cost
      '<div style="padding:12px 14px 4px;border-bottom:0.5px solid var(--br);">'+
        '<div style="font-size:13px;font-weight:500;color:var(--tx);margin-bottom:8px;">Other Cost</div>'+
        '<div id="cost-other">'+buildCostOtherRows(m)+'</div>'+
        '<button onclick="addCostOther()" style="width:100%;padding:9px;margin-top:5px;margin-bottom:8px;border-radius:var(--rads);background:var(--sf2);border:0.5px solid var(--br2);color:var(--tx2);font-size:12px;cursor:pointer;font-family:inherit;">+ Add Other Cost</button>'+
      '</div>'+

      // Total
      '<div style="display:flex;align-items:center;justify-content:space-between;padding:13px 14px;background:var(--pl);">'+
        '<span style="font-size:15px;font-weight:500;color:var(--tx);">Total:</span>'+
        '<span style="font-size:18px;font-weight:600;color:var(--p);" id="costing-total-main">₹ '+calcSupplyTotal(m)+'</span>'+
      '</div>'+
    '</div>'+
  '</div>'+

  '<div class="sec" style="margin-top:10px;">'+
    '<div class="sec-hdr"><span class="sec-title">Techpack</span><span class="sec-act" onclick="toggleTPDropdown()"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg> Link</span></div>'+
    '<div id="tp-linked" style="display:'+(m.techpack?'flex':'none')+';align-items:center;gap:8px;padding:10px 14px;background:var(--gl);border-bottom:0.5px solid var(--br);">'+
      '<svg style="font-size:16px;color:var(--gt);" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8zM14 2v6h6M16 13H8M16 17H8M10 9H8"/></svg>'+
      '<span style="flex:1;font-size:13px;color:var(--tx);" id="tp-linked-name">'+(m.techpack||'')+'</span>'+
      '<span class="tp-linked-badge">Linked</span>'+
      '<span style="font-size:12px;color:var(--tx3);cursor:pointer;" onclick="unlinkTP()"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M18 6L6 18M6 6l12 12"/></svg></span>'+
    '</div>'+
    '<div id="tp-empty" style="display:'+(m.techpack?'none':'flex')+';flex-direction:column;gap:10px;padding:14px;">'+
      '<span style="font-size:13px;color:var(--tx3);">No techpack linked yet.</span>'+
      '<div style="display:flex;gap:8px;flex-wrap:wrap;">'+
        '<button onclick="toggleTPDropdown()" style="padding:7px 13px;border-radius:8px;border:0.5px solid var(--br);background:var(--sf2);color:var(--tx1);font-size:12px;font-weight:500;cursor:pointer;font-family:inherit;">🔗 Link existing</button>'+
        '<button onclick="showToast(\'Create techpack — coming soon\')" style="padding:7px 13px;border-radius:8px;border:0.5px solid var(--br);background:var(--sf2);color:var(--tx1);font-size:12px;font-weight:500;cursor:pointer;font-family:inherit;">✏️ Create techpack</button>'+
        '<button onclick="document.getElementById(\'tp-upload-input\').click()" style="padding:7px 13px;border-radius:8px;border:0.5px solid var(--br);background:var(--sf2);color:var(--tx1);font-size:12px;font-weight:500;cursor:pointer;font-family:inherit;">⬆️ Upload techpack</button>'+
        '<input id="tp-upload-input" type="file" accept=".pdf,.doc,.docx,.png,.jpg" style="display:none;" onchange="handleTPUpload(this)"/>'+
      '</div>'+
    '</div>'+
    '<div id="tp-dropdown" style="display:none;border-top:0.5px solid var(--br);">'+
      '<div style="padding:7px 14px;font-size:11px;color:var(--tx3);">Your techpacks</div>'+
      tpHTML+
      '<div style="padding:10px 14px;"><button style="width:100%;padding:8px;border-radius:var(--rads);background:var(--sf2);border:0.5px dashed var(--br2);color:var(--tx2);font-size:12px;cursor:pointer;font-family:inherit;" onclick="showToast(\'Opening techpack creator…\')"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 5v14M5 12h14"/></svg> Create new techpack</button></div>'+
    '</div>'+
  '</div>'+

  '<div class="sec" style="margin-top:10px;margin-bottom:10px;">'+
    '<div class="sec-hdr"><span class="sec-title">External links</span></div>'+
    '<div class="row-f"><svg style="font-size:15px;color:var(--tx3);margin-right:8px;" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg><input class="rf-inp" type="url" placeholder="Paste any URL (Drive, Notion, Dropbox…)" value="'+(m.externalLink||'')+'"/></div>'+
  '</div>';
}

function addVendor(){
  if(!editMat.vendors)editMat.vendors=[];
  editMat.vendors.push({name:'',type:'primary',lead:'',contact:''});
  document.getElementById('cpg-2').innerHTML=buildSupplyHTML();
}
function removeVendor(vi){
  if(!editMat.vendors)return;
  editMat.vendors.splice(vi,1);
  document.getElementById('cpg-2').innerHTML=buildSupplyHTML();
}

// ═══════════════════════════════
//  SUPPLY TAB COSTING
// ═══════════════════════════════
var _costingExpanded=true;

function calcSupplyTotal(m){
  var mats=((m.costMaterials||[]).reduce(function(s,r){return s+(parseFloat(r.rate||0)*parseFloat(r.qty||0));},0));
  var jobs=((m.costJobwork||[]).reduce(function(s,r){return s+(parseFloat(r.amount||0));},0));
  var other=((m.costOther||[]).reduce(function(s,r){return s+(parseFloat(r.amount||0));},0));
  var t=mats+jobs+other;
  return t.toLocaleString('en-IN',{maximumFractionDigits:2});
}

function recalcSupplyTotal(){
  var t=calcSupplyTotal(editMat);
  var el1=document.getElementById('costing-total-main');
  var el2=document.getElementById('costing-total-badge');
  if(el1)el1.textContent='₹ '+t;
  if(el2)el2.textContent='₹ '+t;
}

function toggleCostingExpand(){
  _costingExpanded=!_costingExpanded;
  var body=document.getElementById('costing-body');
  var btn=document.getElementById('costing-expand-btn');
  if(body)body.style.display=_costingExpanded?'block':'none';
  if(btn)btn.style.transform=_costingExpanded?'':'rotate(180deg)';
}

function setCostingBasis(basis){
  editMat.costingBasis=basis;
  var badge=document.getElementById('costing-basis-badge');
  if(badge)badge.textContent=basis==='order'?'Per Order':'Per Piece';
  var bp=document.getElementById('cb-piece');var bo=document.getElementById('cb-order');
  if(bp){bp.style.background=basis==='piece'?'var(--p)':'var(--sf2)';bp.style.color=basis==='piece'?'#fff':'var(--tx2)';}
  if(bo){bo.style.background=basis==='order'?'var(--p)':'var(--sf2)';bo.style.color=basis==='order'?'#fff':'var(--tx2)';}
}

// ── Material rows ──
var UNITS=['m','cm','kg','g','pcs','yd','L','ml'];
function buildCostMaterialRows(m){
  var rows=m.costMaterials||[];
  if(!rows.length)return'<div style="font-size:12px;color:var(--tx3);padding:0 0 4px;">No materials added</div>';
  return rows.map(function(r,i){
    var amt=(parseFloat(r.rate||0)*parseFloat(r.qty||0)).toFixed(2);
    return '<div style="display:grid;grid-template-columns:2fr 1fr 1.2fr 1.2fr 1.4fr 20px;gap:5px;margin-bottom:6px;align-items:center;">'+
      '<input class="inp" type="text" placeholder="Material" value="'+esc(r.name||'')+'" style="padding:6px 7px;font-size:12px;" oninput="editMat.costMaterials['+i+'].name=this.value"/>'+
      '<input class="inp" type="number" placeholder="0" value="'+(r.qty||'')+'" style="padding:6px 7px;font-size:12px;" oninput="editMat.costMaterials['+i+'].qty=this.value;recalcSupplyMaterialRow('+i+')"/>'+
      '<select class="inp" style="padding:6px 5px;font-size:12px;" onchange="editMat.costMaterials['+i+'].unit=this.value">'+
        UNITS.map(function(u){return '<option'+(r.unit===u?' selected':'')+'>'+u+'</option>';}).join('')+
      '</select>'+
      '<input class="inp" type="number" placeholder="0" value="'+(r.rate||'')+'" style="padding:6px 7px;font-size:12px;" oninput="editMat.costMaterials['+i+'].rate=this.value;recalcSupplyMaterialRow('+i+')"/>'+
      '<input class="inp" type="text" value="'+amt+'" id="cmat-amt-'+i+'" style="padding:6px 7px;font-size:12px;background:var(--sf2);" readonly/>'+
      '<button onclick="removeCostMaterial('+i+')" style="background:none;border:none;cursor:pointer;color:var(--r);font-size:16px;line-height:1;padding:0;display:flex;align-items:center;justify-content:center;">×</button>'+
    '</div>';
  }).join('');
}
function recalcSupplyMaterialRow(i){
  var r=editMat.costMaterials[i];
  var amt=(parseFloat(r.rate||0)*parseFloat(r.qty||0));
  var el=document.getElementById('cmat-amt-'+i);
  if(el)el.value=amt.toFixed(2);
  recalcSupplyTotal();
}
function addCostMaterial(){
  if(!editMat.costMaterials)editMat.costMaterials=[];
  editMat.costMaterials.push({name:'',qty:'',unit:'m',rate:'',amount:0});
  document.getElementById('cost-materials').innerHTML=buildCostMaterialRows(editMat);
}
function removeCostMaterial(i){
  editMat.costMaterials.splice(i,1);
  document.getElementById('cost-materials').innerHTML=buildCostMaterialRows(editMat);
  recalcSupplyTotal();
}

// ── Jobwork rows ──
function buildCostJobRows(m){
  var rows=m.costJobwork||[];
  if(!rows.length)return'<div style="font-size:12px;color:var(--tx3);padding:0 0 4px;">No jobwork added</div>';
  return rows.map(function(r,i){
    return '<div style="display:grid;grid-template-columns:1fr 1fr 20px;gap:7px;margin-bottom:6px;align-items:center;">'+
      '<input class="inp" type="text" placeholder="Job Description" value="'+esc(r.desc||'')+'" style="padding:7px 9px;font-size:12px;" oninput="editMat.costJobwork['+i+'].desc=this.value"/>'+
      '<input class="inp" type="number" placeholder="Amount" value="'+(r.amount||'')+'" style="padding:7px 9px;font-size:12px;" oninput="editMat.costJobwork['+i+'].amount=parseFloat(this.value)||0;recalcSupplyTotal()"/>'+
      '<button onclick="removeCostJobwork('+i+')" style="background:none;border:none;cursor:pointer;color:var(--r);font-size:16px;line-height:1;padding:0;display:flex;align-items:center;justify-content:center;">×</button>'+
    '</div>';
  }).join('');
}
function addCostJobwork(){
  if(!editMat.costJobwork)editMat.costJobwork=[];
  editMat.costJobwork.push({desc:'',amount:0});
  document.getElementById('cost-jobwork').innerHTML=buildCostJobRows(editMat);
}
function removeCostJobwork(i){
  editMat.costJobwork.splice(i,1);
  document.getElementById('cost-jobwork').innerHTML=buildCostJobRows(editMat);
  recalcSupplyTotal();
}

// ── Other Cost rows ──
function buildCostOtherRows(m){
  var rows=m.costOther||[];
  if(!rows.length)return'<div style="font-size:12px;color:var(--tx3);padding:0 0 4px;">No other costs added</div>';
  return rows.map(function(r,i){
    return '<div style="display:grid;grid-template-columns:1fr 1fr 20px;gap:7px;margin-bottom:6px;align-items:center;">'+
      '<input class="inp" type="text" placeholder="Description" value="'+esc(r.desc||'')+'" style="padding:7px 9px;font-size:12px;" oninput="editMat.costOther['+i+'].desc=this.value"/>'+
      '<input class="inp" type="number" placeholder="Amount" value="'+(r.amount||'')+'" style="padding:7px 9px;font-size:12px;" oninput="editMat.costOther['+i+'].amount=parseFloat(this.value)||0;recalcSupplyTotal()"/>'+
      '<button onclick="removeCostOther('+i+')" style="background:none;border:none;cursor:pointer;color:var(--r);font-size:16px;line-height:1;padding:0;display:flex;align-items:center;justify-content:center;">×</button>'+
    '</div>';
  }).join('');
}
function addCostOther(){
  if(!editMat.costOther)editMat.costOther=[];
  editMat.costOther.push({desc:'',amount:0});
  document.getElementById('cost-other').innerHTML=buildCostOtherRows(editMat);
}
function removeCostOther(i){
  editMat.costOther.splice(i,1);
  document.getElementById('cost-other').innerHTML=buildCostOtherRows(editMat);
  recalcSupplyTotal();
}

function openSupplyReserveSheet(){
  // build variant options
  var opts=(editMat.variants||[]).map(function(v,i){
    return '<option value="'+i+'">'+esc(v.name||'Variant '+(i+1))+' ('+esc(v.sku||'')+')</option>';
  }).join('');
  // inject variant selector into reserve sheet
  var note=document.getElementById('res-avail-note');
  if(note){
    note.innerHTML='<div class="lbl" style="margin-bottom:4px;">Variant</div>'+
      '<select class="inp" id="res-var-sel" onchange="updateSupplyResAvail()" style="margin-bottom:4px;">'+opts+'</select>';
  }
  // pick first variant by default
  _reserveVarIdx=0;
  updateSupplyResAvail();
  document.getElementById('res-order').value='ORD-'+(1000+Math.floor(Math.random()*9000));
  document.getElementById('res-customer').value='';
  document.getElementById('res-qty').value='';
  document.getElementById('res-status').value='confirmed';
  document.getElementById('res-date').value=new Date().toISOString().split('T')[0];
  openSheet('sh-reserve');
}

function updateSupplyResAvail(){
  var sel=document.getElementById('res-var-sel');
  if(!sel)return;
  var vi=parseInt(sel.value)||0;
  _reserveVarIdx=vi;
  var v=editMat.variants[vi];
  if(!v)return;
  var inv=v.inventory||{};
  function grpTotal(arr){return(arr||[]).reduce(function(s,l){return s+(parseInt(l.qty)||0);},0);}
  var ts=grpTotal(inv.stores)+grpTotal(inv.jobbers)+grpTotal(inv.production)+grpTotal(inv.warehouse);
  var reserved=(v.reservations||[]).reduce(function(s,r){return s+(parseInt(r.qty)||0);},0);
  var avail=Math.max(0,ts-reserved);
  // append availability note after select
  var note=document.getElementById('res-avail-note');
  if(note){
    var existing=note.querySelector('.avail-note');
    if(existing)existing.remove();
    var d=document.createElement('div');
    d.className='avail-note';
    d.style.cssText='font-size:12px;color:var(--tx2);margin-top:6px;';
    d.textContent='Available: '+avail+' units ('+ts+' total − '+reserved+' reserved)';
    note.appendChild(d);
  }
}

// ═══════════════════════════════
//  OPTION CATEGORIES
// ═══════════════════════════════
function getCombos(){
  var cats=(editMat.cats||[]).filter(function(c){return c.values.length>0;});
  if(!cats.length)return 0;
  return cats.reduce(function(s,c){return s*c.values.length;},1);
}
function rebuildVariantsPage(){
  document.getElementById('cpg-0').innerHTML=buildInfoHTML();
}
function quickAddCat(name){
    if((editMat.cats||[]).some(function(c){return c.name.toLowerCase()===name.toLowerCase();})){showToast('"'+name+'" already added');return;}
  if(!editMat.cats)editMat.cats=[];
  editMat.cats.push({name:name,style:catStyle(name),values:[]});
  var ci=editMat.cats.length-1;
  rebuildVariantsPage();
}
function addCat(){
  var inp=document.getElementById('new-cat-inp');
  var name=(inp.value||'').trim();
  if(!name)return;
  if((editMat.cats||[]).some(function(c){return c.name.toLowerCase()===name.toLowerCase();})){showToast('Category exists');return;}
  if(!editMat.cats)editMat.cats=[];
  editMat.cats.push({name:name,style:catStyle(name),values:[]});
  var ci=editMat.cats.length-1;
  inp.value='';
  rebuildVariantsPage();
  var hasSets=optionSets.some(function(s){return s.cat.toLowerCase()===name.toLowerCase();});
}
function deleteCat(ci){
  if(!confirm('Remove "'+editMat.cats[ci].name+'" and all its values?'))return;
  editMat.cats.splice(ci,1);
  rebuildVariantsPage();
}
function addVal(ci){
  var inp=document.getElementById('vi-'+ci);
  var v=(inp?inp.value:'').trim();
  if(!v)return;
  if(editMat.cats[ci].values.includes(v)){showToast('"'+v+'" already exists');return;}
  editMat.cats[ci].values.push(v);
  inp.value='';
  rebuildVariantsPage();
}
function delVal(ci,vi){editMat.cats[ci].values.splice(vi,1);rebuildVariantsPage();}

function cartesian(arrs){
  if(!arrs.length)return[[]];
  return arrs.reduce(function(acc,arr){var r=[];acc.forEach(function(a){arr.forEach(function(b){r.push(a.concat([b]));});});return r;},[[]]);
}
function generateVariants(){
  var cats=(editMat.cats||[]).filter(function(c){return c.values.length>0;});
  if(!cats.length){showToast('Add at least one category with values');return;}
  var combos=cartesian(cats.map(function(c){return c.values.map(function(v){return {cat:c,val:v};});}));
  editMat.variants=combos.map(function(combo){
    var name=combo.map(function(x){return x.val;}).join(' / ');
    var skuSuffix=combo.map(function(x){return x.val.toUpperCase().replace(/\s+/g,'-');}).join('-');
    var sku=(editMat.sku||'MT')+'-'+skuSuffix;
    return {name:name,sku:sku,mrp:'',offer:'',cost:'',qty:0,barcode:sku,minqty:0,color:COLORS[combos.indexOf(combo)%COLORS.length],tags:combo.map(function(x){return {label:x.val,style:x.cat.style};}),images:[],notes:'',
      costLines:[{label:'Fabric',val:0},{label:'Labour',val:0},{label:'Packaging',val:0}],
      inventory:{stores:[{loc:'VB Asansol',qty:0,color:'#4A3BB5'}],jobbers:[],production:[{loc:'Factory floor',qty:0,color:'#639922'}],warehouse:[]}
    };
  });
  rebuildVariantsPage();
  showToast(editMat.variants.length+' variants generated');
}
function adjVQ(vi,d){
  editMat.variants[vi].qty=Math.max(0,(parseInt(editMat.variants[vi].qty)||0)+d);
  var el=document.getElementById('vmq-'+vi);
  if(el)el.value=editMat.variants[vi].qty;
}
function genBarcode(vi){
  var sku=editMat.variants[vi].sku||'';
  editMat.variants[vi].barcode=sku;
  var inp=document.getElementById('bci-'+vi);
  if(inp)inp.value=sku;
  showToast('Barcode set to SKU');
}

// ═══════════════════════════════
//  SAVE MATERIAL
// ═══════════════════════════════
function saveMaterial(){
  var tEl=document.getElementById('f-title');
  var title=tEl?tEl.value.trim():'';
  if(!title){showToast('Product title is required');if(tEl)tEl.focus();return;}
  if(document.getElementById('f-desc'))editMat.desc=document.getElementById('f-desc').value;
  if(document.getElementById('f-notes'))editMat.notes=document.getElementById('f-notes').value;
  editMat.name=title;
  editMat.type=document.getElementById('f-type')?document.getElementById('f-type').value:'finished';
  editMat.sku=document.getElementById('f-sku')?document.getElementById('f-sku').value:'';
  if(!editMat.vendors)editMat.vendors=[];
  editMat.imgs=uploadedImgs.slice();
  if(editingId){Object.assign(materials.find(function(x){return x.id===editingId;}),editMat);}
  else{editMat.id=Date.now();materials.unshift(editMat);}
  showToast(editingId?'Material updated ✓':'Material created ✓');
  screenStack=[];showScreen('list');renderList();
}

// ═══════════════════════════════
//  MATERIAL DETAIL SCREEN
// ═══════════════════════════════
var curMDetailId=null;
var curMDTab=0;
var movements=[
  {id:1,matId:1,varIdx:0,date:'2026-10-01',type:'IN',qty:20,ref:'PO-2345',by:'Admin',notes:'Received from Sabrang Textiles'},
  {id:2,matId:1,varIdx:0,date:'2026-10-15',type:'OUT',qty:8,ref:'ORD-1001',by:'Admin',notes:'Sold batch order'},
  {id:3,matId:1,varIdx:1,date:'2026-10-18',type:'IN',qty:10,ref:'PO-2346',by:'Admin',notes:''},
  {id:4,matId:2,varIdx:0,date:'2026-10-05',type:'IN',qty:15,ref:'PO-1200',by:'Admin',notes:'Opening stock'},
  {id:5,matId:2,varIdx:0,date:'2026-10-22',type:'OUT',qty:7,ref:'ORD-1020',by:'Admin',notes:''},
  {id:6,matId:4,varIdx:0,date:'2026-10-10',type:'IN',qty:20,ref:'PO-3000',by:'Admin',notes:''},
  {id:7,matId:4,varIdx:2,date:'2026-10-28',type:'OUT',qty:5,ref:'ORD-1050',by:'Admin',notes:''},
  {id:8,matId:5,varIdx:0,date:'2026-09-28',type:'IN',qty:25,ref:'PO-2100',by:'Admin',notes:'Season stock'},
  {id:9,matId:5,varIdx:1,date:'2026-10-12',type:'ADJ',qty:2,ref:'ADJ-003',by:'Admin',notes:'Damaged goods written off'},
  {id:10,matId:8,varIdx:1,date:'2026-10-03',type:'IN',qty:12,ref:'PO-1800',by:'Admin',notes:''},
  {id:11,matId:12,varIdx:0,date:'2026-10-01',type:'IN',qty:300,ref:'PO-5001',by:'Admin',notes:'Bulk fabric purchase'},
  {id:12,matId:12,varIdx:0,date:'2026-10-20',type:'OUT',qty:100,ref:'PROD-401',by:'Admin',notes:'Used in production run'},
];
var _mvNextId=100;
var _mvMatId=null;

function openMDetail(matId){
  curMDetailId=matId;
  var m=materials.find(function(x){return x.id===matId;});
  if(!m)return;
  editingId=matId;
  editMat=JSON.parse(JSON.stringify(m));
  document.getElementById('md-title').textContent=m.name;
  setMDTab(0);
  pushScreen('mdetail');
}
function editCurrentMat(){
  if(!curMDetailId)return;
  openEdit(curMDetailId);
}
function setMDTab(n){
  curMDTab=n;
  [0,1,2,3].forEach(function(i){
    var t=document.getElementById('mdtab-'+i);if(t)t.classList.toggle('on',i===n);
    var p=document.getElementById('mdpg-'+i);if(p)p.style.display=i===n?'block':'none';
  });
  var m=materials.find(function(x){return x.id===curMDetailId;});
  if(!m)return;
  if(n===0)buildMDOverview(m);
  else if(n===1)buildMDVariants(m);
  else if(n===2)buildMDMovement(m);
  else if(n===3)buildMDSupply(m);
}
function buildMDOverview(m){
  var totalQty=m.variants.reduce(function(a,v){return a+(v.qty||0);},0);
  var avgCost=m.variants.length?Math.round(m.variants.reduce(function(a,v){return a+(v.cost||0);},0)/m.variants.length):0;
  var totalVal=m.variants.reduce(function(a,v){return a+(v.qty||0)*(v.cost||0);},0);
  var typeBg={'finished':'var(--p)','raw':'var(--g)','production':'var(--a)'};
  var html='<div style="background:var(--sf);margin:10px 12px 0;border-radius:var(--rad);border:0.5px solid var(--br);overflow:hidden;">'+
    '<div style="display:flex;align-items:center;gap:13px;padding:14px;">'+
      '<div style="width:60px;height:60px;border-radius:10px;background:var(--sf2);border:0.5px solid var(--br);display:flex;align-items:center;justify-content:center;flex-shrink:0;">'+
        '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--tx3)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20.38 3.46L16 2a4 4 0 0 1-8 0L3.62 3.46a2 2 0 0 0-1.34 2.23l.58 3.57a1 1 0 0 0 .99.84H6v10a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V10h2.15a1 1 0 0 0 .99-.84l.58-3.57a2 2 0 0 0-1.34-2.23z"/></svg>'+
      '</div>'+
      '<div style="flex:1;min-width:0;">'+
        '<div style="font-size:14px;font-weight:600;color:var(--tx);margin-bottom:4px;">'+esc(m.name)+'</div>'+
        '<div style="display:flex;gap:6px;align-items:center;flex-wrap:wrap;">'+
          '<span style="font-size:11px;padding:2px 8px;border-radius:20px;background:var(--sf2);border:0.5px solid var(--br2);color:var(--tx2);">'+esc(m.sku||'No SKU')+'</span>'+
          '<span style="font-size:11px;padding:2px 8px;border-radius:20px;background:'+(typeBg[m.type]||'var(--p)')+';color:#fff;font-weight:500;">'+m.type+'</span>'+
        '</div>'+
      '</div>'+
    '</div></div>'+
  '<div style="display:grid;grid-template-columns:1fr 1fr;gap:7px;padding:10px 12px 4px;">'+
    '<div style="background:var(--sf);border-radius:9px;border:0.5px solid var(--br);padding:9px 11px;">'+
      '<div style="font-size:10px;color:var(--tx3);">Total stock</div>'+
      '<div style="font-size:18px;font-weight:600;color:'+(totalQty>0?'var(--g)':'var(--r)')+';">'+totalQty+'</div>'+
    '</div>'+
    '<div style="background:var(--sf);border-radius:9px;border:0.5px solid var(--br);padding:9px 11px;">'+
      '<div style="font-size:10px;color:var(--tx3);">Variants</div>'+
      '<div style="font-size:18px;font-weight:600;color:var(--tx);">'+m.variants.length+'</div>'+
    '</div>'+
    '<div style="background:var(--sf);border-radius:9px;border:0.5px solid var(--br);padding:9px 11px;">'+
      '<div style="font-size:10px;color:var(--tx3);">Avg. cost</div>'+
      '<div style="font-size:16px;font-weight:500;color:var(--tx);">Rs.'+avgCost+'</div>'+
    '</div>'+
    '<div style="background:var(--sf);border-radius:9px;border:0.5px solid var(--br);padding:9px 11px;">'+
      '<div style="font-size:10px;color:var(--tx3);">Stock value</div>'+
      '<div style="font-size:16px;font-weight:500;color:var(--tx);">Rs.'+totalVal.toLocaleString('en-IN')+'</div>'+
    '</div>'+
  '</div>'+
  '<div style="display:flex;gap:8px;padding:8px 12px 8px;">'+
    '<button onclick="openAddLabelForMat('+m.id+')" style="flex:1;padding:9px 4px;border-radius:var(--rads);background:var(--pl);border:0.5px solid var(--pm);color:var(--pt);font-size:12px;font-weight:500;cursor:pointer;font-family:inherit;">🏷 Print labels</button>'+
    '<button onclick="openAddMovement('+m.id+')" style="flex:1;padding:9px 4px;border-radius:var(--rads);background:var(--gl);border:0.5px solid #C0DD97;color:var(--gt);font-size:12px;font-weight:500;cursor:pointer;font-family:inherit;">↑ Add stock</button>'+
    '<button onclick="editCurrentMat()" style="flex:1;padding:9px 4px;border-radius:var(--rads);background:var(--sf2);border:0.5px solid var(--br2);color:var(--tx2);font-size:12px;font-weight:500;cursor:pointer;font-family:inherit;">✎ Edit</button>'+
  '</div>';
  if(m.desc){html+='<div style="padding:2px 14px 12px;font-size:13px;color:var(--tx2);line-height:1.5;">'+esc(m.desc)+'</div>';}
  document.getElementById('mdpg-0').innerHTML=html;
}
function buildMDVariants(m){
  var html='<div style="padding:10px 14px 4px;display:flex;align-items:center;justify-content:space-between;"><span style="font-size:12px;font-weight:500;color:var(--tx2);">'+m.variants.length+' variant'+(m.variants.length===1?'':'s')+'</span></div>'+
  '<div style="background:var(--sf);margin:0 12px 8px;border-radius:var(--rad);border:0.5px solid var(--br);overflow:hidden;">';
  m.variants.forEach(function(v,vi){
    var qOk=v.qty>=(v.minqty||0);
    html+='<div class="vrow" style="cursor:pointer;" onclick="openVarDetail('+vi+')">'+
      '<span class="vi-in"><span class="vi-ln"></span><span class="vi-cn"></span></span>'+
      '<div class="vi-inner">'+
        '<span class="vdot" style="background:'+(v.color||'#999')+'"></span>'+
        '<div class="viinf"><div class="viname">'+esc(v.name||'Variant')+'</div><div class="visku">'+esc(v.sku||'')+'</div></div>'+
        '<span class="viqty '+(qOk?'ok':'lo')+'">'+v.qty+'</span>'+
        '<span style="font-size:11px;color:var(--tx2);margin-left:6px;">Rs.'+(v.offer||v.mrp||0)+'</span>'+
        '<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="var(--tx3)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-left:6px;flex-shrink:0;"><path d="M9 18l6-6-6-6"/></svg>'+
      '</div></div>';
  });
  html+='</div>';
  document.getElementById('mdpg-1').innerHTML=html;
}
/* buildMDMovement replaced by v6 version above */
function buildMDSupply(m){
  var html='<div style="display:flex;align-items:center;justify-content:space-between;padding:10px 14px 6px;">'+
    '<span style="font-size:12px;font-weight:500;color:var(--tx2);">'+m.vendors.length+' vendor'+(m.vendors.length===1?'':'s')+'</span></div>';
  if(!m.vendors.length){
    html+='<div style="text-align:center;padding:30px 20px;color:var(--tx3);font-size:13px;">No vendors assigned</div>';
  } else {
    html+='<div style="background:var(--sf);margin:0 12px 8px;border-radius:var(--rad);border:0.5px solid var(--br);overflow:hidden;">';
    m.vendors.forEach(function(vnd){
      html+='<div style="padding:12px 14px;border-bottom:0.5px solid var(--br);">'+
        '<div style="display:flex;align-items:center;gap:8px;margin-bottom:4px;">'+
          '<span style="font-size:13px;font-weight:500;color:var(--tx);">'+esc(vnd.name)+'</span>'+
          '<span style="font-size:10px;padding:2px 7px;border-radius:20px;background:'+(vnd.type==='primary'?'var(--pl)':'var(--sf2)')+';color:'+(vnd.type==='primary'?'var(--pt)':'var(--tx2)')+';border:0.5px solid '+(vnd.type==='primary'?'var(--pm)':'var(--br2)')+';">'+vnd.type+'</span>'+
        '</div>'+
        '<div style="display:flex;gap:14px;font-size:12px;color:var(--tx2);">'+
          (vnd.lead?'<span>Lead time: '+esc(vnd.lead)+'</span>':'')+
          (vnd.contact?'<a href="tel:'+esc(vnd.contact)+'" style="color:var(--p);">'+esc(vnd.contact)+'</a>':'')+
        '</div></div>';
    });
    html+='</div>';
  }
  document.getElementById('mdpg-3').innerHTML=html;
}
function openAddLabelForMat(matId){
  _alMatId=matId;_alVarIdx=0;
  openAddLabelSheet();
  pushScreen('labels');
}
function openAddMovement(matId){
  var m=materials.find(function(x){return x.id===matId;});
  if(!m)return;
  _mvMatId=matId;
  var sel=document.getElementById('mv-variant');
  if(sel){sel.innerHTML=m.variants.map(function(v,i){return '<option value="'+i+'">'+esc(v.name||'Variant '+(i+1))+'</option>';}).join('');}
  var di=document.getElementById('mv-date');
  if(di)di.value=new Date().toISOString().slice(0,10);
  openSheet('sh-movement');
}
/* setMvType replaced by v6 */
function saveMovement(){
  var m=materials.find(function(x){return x.id===_mvMatId;});
  if(!m)return;
  var type=document.getElementById('mv-type').value||'IN';
  var vi=parseInt(document.getElementById('mv-variant').value)||0;
  var qty=parseInt(document.getElementById('mv-qty').value)||0;
  var ref=document.getElementById('mv-ref').value;
  var notes=document.getElementById('mv-notes').value;
  var date=document.getElementById('mv-date').value||new Date().toISOString().slice(0,10);
  if(!qty){showToast('Enter a quantity');return;}
  movements.push({id:_mvNextId++,matId:_mvMatId,varIdx:vi,date:date,type:type,qty:qty,ref:ref,by:'Admin',notes:notes});
  if(type==='IN')m.variants[vi].qty=(m.variants[vi].qty||0)+qty;
  else if(type==='OUT')m.variants[vi].qty=Math.max(0,(m.variants[vi].qty||0)-qty);
  closeSheet('sh-movement');
  showToast('Movement saved ✓');
  if(curMDetailId===_mvMatId){var mat=materials.find(function(x){return x.id===_mvMatId;});if(mat&&curMDTab===2)buildMDMovement(mat);}
  renderList();
}

// ═══════════════════════════════
//  VARIANT DETAIL SCREEN
// ═══════════════════════════════
function openVarDetail(vi){
  curVarIdx=vi;
  var v=editMat.variants[vi];
  document.getElementById('vd-title').textContent=(v.name||'Variant '+(vi+1));
  setVTab(0);buildVDPages(v,vi);
  pushScreen('vdetail');
}
function setVTab(n){
  curVTab=n;
  [0,1,2].forEach(function(i){
    var t=document.getElementById('vtab-'+i);if(t)t.classList.toggle('on',i===n);
    var p=document.getElementById('vpg-'+i);if(p)p.style.display=i===n?'block':'none';
  });
}
function buildVDPages(v,vi){
  document.getElementById('vpg-0').innerHTML=buildVDPricingHTML(v,vi);
  document.getElementById('vpg-1').innerHTML=buildVDInventoryHTML(v,vi);
  document.getElementById('vpg-2').innerHTML=buildVDTechpackHTML(v,vi);
  setTimeout(function(){renderBCCanvas(v.barcode||v.sku||'','vd-bc-canvas','vd-bc-lbl');},50);
  setTimeout(function(){calcVDDiscount();calcVDMargin();},50);
}
function buildVDPricingHTML(v,vi){
  return '<div class="apply-banner">'+
    '<div class="apply-icon"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M8 4H6a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-4-4H8v4h8M8 12h8M8 16h4"/></svg></div>'+
    '<div class="apply-text"><div class="apply-title">Apply to all variants</div><div class="apply-sub">Copy pricing, images or inventory</div></div>'+
    '<button class="apply-btn" onclick="openSheet(\'sh-bulk\')">Apply</button></div>'+
  '<div class="sec" style="margin-top:10px;">'+
    '<div class="sec-hdr"><span class="sec-title">Pricing</span></div>'+
    '<div class="price-grid">'+
      '<div class="pc"><div class="pc-lbl">MRP</div><div class="pc-row"><span class="pc-pre">Rs.</span><input class="pc-inp" id="vd-mrp" type="text" value="'+(v.mrp||'')+'" oninput="calcVDDiscount();calcVDMargin()"/></div></div>'+
      '<div class="pc"><div class="pc-lbl">Offer price</div><div class="pc-row"><span class="pc-pre">Rs.</span><input class="pc-inp offer" id="vd-offer" type="text" value="'+(v.offer||'')+'" oninput="calcVDDiscount();calcVDMargin()"/></div><div class="disc-pill" id="vd-disc" style="display:none;"><svg style="font-size:11px;" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82zM7 7h.01"/></svg> 0% off</div></div>'+
      '<div class="pc"><div class="pc-lbl">Cost price</div><div class="pc-row"><span class="pc-pre">Rs.</span><input class="pc-inp" id="vd-cost" type="text" value="'+(v.cost||'')+'" oninput="calcVDMargin()"/></div></div>'+
      '<div class="pc"><div class="pc-lbl">Gross margin</div><div id="vd-margin" style="font-size:13px;font-weight:500;color:var(--g);margin-top:4px;">—</div></div>'+
    '</div>'+
  '</div>'+
  '<div class="sec" style="margin-top:10px;">'+
    '<div class="sec-hdr"><span class="sec-title">SKU and barcode</span></div>'+
    '<div class="row-f"><span class="rf-lbl">Variant name</span><input class="rf-inp" id="vd-name" type="text" value="'+esc(v.name||'')+'"/></div>'+
    '<div class="row-f"><span class="rf-lbl">SKU</span><input class="rf-inp" id="vd-sku" type="text" value="'+esc(v.sku||'')+'" oninput="document.getElementById(\'vd-bc-inp\').value=this.value"/></div>'+
    '<div class="row-f"><span class="rf-lbl">Barcode</span><input class="rf-inp" id="vd-bc-inp" type="text" value="'+esc(v.barcode||v.sku||'')+'" oninput="renderBCCanvas(this.value,\'vd-bc-canvas\',\'vd-bc-lbl\')"/><span style="font-size:11px;color:var(--p);cursor:pointer;margin-left:6px;" onclick="renderBCCanvas(document.getElementById(\'vd-bc-inp\').value,\'vd-bc-canvas\',\'vd-bc-lbl\')"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 4v5h5M20 20v-5h-5M20.49 9A9 9 0 0 0 5.64 5.64L4 9M3.51 15a9 9 0 0 0 14.85 3.36L20 15"/></svg></span></div>'+
    '<div class="bc-preview"><canvas id="vd-bc-canvas" height="56" width="220"></canvas><p id="vd-bc-lbl"></p>'+
      '<div class="bc-acts"><button class="bc-dl" onclick="downloadBC(\'vd-bc-canvas\',document.getElementById(\'vd-bc-inp\').value)"><svg style="font-size:12px;" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M7 10l5 5 5-5M12 15V3"/></svg> PNG</button>'+
      '<button class="bc-cp" onclick="copyBC(document.getElementById(\'vd-bc-inp\').value)"><svg style="font-size:12px;" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M8 4H6a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-4-4H8v4h8M8 12h8M8 16h4"/></svg> Copy</button></div>'+
    '</div>'+
    '<div class="row-f" style="border-top:0.5px solid var(--br);"><span class="rf-lbl">Min quantity</span><input class="rf-inp" id="vd-minqty" type="number" value="'+(v.minqty||0)+'" min="0"/></div>'+
  '</div>';
}
function calcVDDiscount(){
  var mrp=parseFloat(document.getElementById('vd-mrp')?document.getElementById('vd-mrp').value:0)||0;
  var offer=parseFloat(document.getElementById('vd-offer')?document.getElementById('vd-offer').value:0)||0;
  var dp=document.getElementById('vd-disc');
  if(!dp)return;
  if(mrp>0&&offer<mrp&&offer>0){var pct=Math.round((mrp-offer)/mrp*100);dp.innerHTML='<svg style="font-size:11px;" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82zM7 7h.01"/></svg> '+pct+'% off';dp.style.display='inline-flex';}
  else{dp.style.display='none';}
}
function calcVDMargin(){
  var offer=parseFloat(document.getElementById('vd-offer')?document.getElementById('vd-offer').value:0)||0;
  var cost=parseFloat(document.getElementById('vd-cost')?document.getElementById('vd-cost').value:0)||0;
  var md=document.getElementById('vd-margin');
  if(!md)return;
  if(offer>0&&cost>0){var m=Math.round((offer-cost)/offer*1000)/10;md.textContent=m+'%';md.style.color=m>=30?'var(--g)':m>=15?'var(--a)':'var(--r)';}
  else{md.textContent='—';}
}

function buildVDInventoryHTML(v,vi){
  var inv=v.inventory||{stores:[],jobbers:[],production:[],warehouse:[]};
  var reservations=v.reservations||[];

  // ── total stock ──
  function grpTotal(arr){return(arr||[]).reduce(function(s,l){return s+(parseInt(l.qty)||0);},0);}
  var ts=grpTotal(inv.stores)+grpTotal(inv.jobbers)+grpTotal(inv.production)+grpTotal(inv.warehouse);
  var reserved=reservations.reduce(function(s,r){return s+(parseInt(r.qty)||0);},0);
  var available=Math.max(0,ts-reserved);

  // ── location rows ──
  function locHTML(arr,icon,bg,title,iconColor){
    if(!arr||!arr.length)return'';
    var total=arr.reduce(function(s,l){return s+(parseInt(l.qty)||0);},0);
    var qc=total===0?'lo':'ok';
    var rows=arr.map(function(l,li){
      return '<div class="inv-vrow"><div class="inv-vdot" style="background:'+(l.color||'#4A3BB5')+'"></div>'+
        '<div class="inv-vname">'+esc(l.loc)+'</div>'+
        '<div class="inv-stp"><button class="inv-stb" onclick="adjInvLoc('+vi+',\''+grpKey(title)+'\','+li+',-1)">−</button>'+
        '<input class="inv-stv" id="il-'+vi+'-'+grpKey(title)+'-'+li+'" type="text" value="'+(parseInt(l.qty)||0)+'" oninput="updInvLoc('+vi+',\''+grpKey(title)+'\','+li+',parseInt(this.value)||0)"/>'+
        '<button class="inv-stb" onclick="adjInvLoc('+vi+',\''+grpKey(title)+'\','+li+',1)">+</button></div>'+
      '</div>';
    }).join('');
    return '<div class="inv-loc">'+
      '<div class="inv-loc-hdr"><div class="inv-loc-ico" style="background:'+bg+';color:'+iconColor+'">'+ico(icon,15)+'</div>'+
      '<div class="inv-loc-name">'+title+'</div><div class="inv-loc-total '+qc+'">'+total+'</div></div>'+
      rows+'</div>';
  }

  // ── stock history data (sample — 12 weeks) ──
  var stockHistory=v.stockHistory||[
    {w:'Jul W1',qty:ts+8},{w:'Jul W2',qty:ts+5},{w:'Jul W3',qty:ts+12},{w:'Jul W4',qty:ts+9},
    {w:'Aug W1',qty:ts+6},{w:'Aug W2',qty:ts+3},{w:'Aug W3',qty:ts+14},{w:'Aug W4',qty:ts+10},
    {w:'Sep W1',qty:ts+7},{w:'Sep W2',qty:ts+4},{w:'Sep W3',qty:ts+2},{w:'Sep W4',qty:ts},
  ];
  var maxQty=Math.max.apply(null,stockHistory.map(function(d){return d.qty;}))||1;
  var minQty=Math.min.apply(null,stockHistory.map(function(d){return d.qty;}))||0;
  var range=maxQty-minQty||1;
  var W=320,H=90,PAD=6,pts=stockHistory.length;
  var stepX=(W-PAD*2)/(pts-1);
  // build SVG polyline
  var polyPts=stockHistory.map(function(d,i){
    var x=PAD+i*stepX;
    var y=H-PAD-(d.qty-minQty)/range*(H-PAD*2);
    return x.toFixed(1)+','+y.toFixed(1);
  }).join(' ');
  // area fill path
  var firstX=PAD,lastX=PAD+(pts-1)*stepX;
  var firstY=H-PAD-(stockHistory[0].qty-minQty)/range*(H-PAD*2);
  var lastY=H-PAD-(stockHistory[pts-1].qty-minQty)/range*(H-PAD*2);
  var areaPath='M'+firstX.toFixed(1)+','+firstY.toFixed(1)+' L'+polyPts.split(' ').slice(1).join(' L')+' L'+lastX.toFixed(1)+','+(H-PAD)+' L'+firstX.toFixed(1)+','+(H-PAD)+' Z';

  // ── reservations HTML ──
  var resRows=reservations.length?reservations.map(function(r,ri){
    var sc={confirmed:'background:#EAF3DE;color:#3B6D11;',pending:'background:#FAEEDA;color:#854F0B;',partial:'background:#E6F1FB;color:#0C447C;'}[r.status]||'background:var(--sf2);color:var(--tx2);';
    return '<div style="display:flex;align-items:center;gap:10px;padding:10px 14px;border-bottom:0.5px solid var(--br);">'+
      '<div style="flex:1;min-width:0;">'+
        '<div style="font-size:13px;font-weight:500;color:var(--tx);">'+esc(r.order)+'</div>'+
        '<div style="font-size:11px;color:var(--tx2);margin-top:2px;">'+esc(r.customer)+' · '+esc(r.date)+'</div>'+
      '</div>'+
      '<div style="text-align:right;flex-shrink:0;">'+
        '<div style="font-size:13px;font-weight:500;color:var(--p);margin-bottom:3px;">'+r.qty+' units</div>'+
        '<span style="font-size:10px;padding:2px 8px;border-radius:20px;font-weight:500;'+sc+'">'+r.status.charAt(0).toUpperCase()+r.status.slice(1)+'</span>'+
      '</div>'+
      '<button onclick="removeReservation('+vi+','+ri+')" style="width:24px;height:24px;border-radius:50%;border:0.5px solid var(--br2);background:var(--sf2);cursor:pointer;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-left:2px;">'+ico('x',12)+'</button>'+
    '</div>';
  }).join(''):'<div style="padding:14px;font-size:13px;color:var(--tx3);text-align:center;">No reservations for this variant</div>';

  return (
    // ── Summary ──
    '<div class="inv-sum">'+
      '<div class="inv-sc"><div class="inv-sc-l">Total stock</div><div class="inv-sc-v '+(ts>0?'ok':'lo')+'">'+ts+'</div></div>'+
      '<div class="inv-sc"><div class="inv-sc-l">Reserved</div><div class="inv-sc-v" style="color:'+(reserved?'var(--a)':'var(--tx3)')+'">'+reserved+'</div></div>'+
      '<div class="inv-sc"><div class="inv-sc-l">Available</div><div class="inv-sc-v '+(available>0?'ok':'lo')+'">'+available+'</div></div>'+
      '<div class="inv-sc"><div class="inv-sc-l">Min qty</div><div class="inv-sc-v">'+(v.minqty||0)+'</div></div>'+
    '</div>'+

    // ── Stock graph ──
    '<div style="background:var(--sf);border-radius:var(--rad);margin:7px 12px 0;border:0.5px solid var(--br);overflow:hidden;">'+
      '<div style="display:flex;align-items:center;justify-content:space-between;padding:10px 14px 6px;">'+
        '<span style="font-size:13px;font-weight:500;color:var(--tx);">Stock over time</span>'+
        '<span style="font-size:11px;color:var(--tx3);">Last 12 weeks</span>'+
      '</div>'+
      '<div style="padding:0 10px 10px;overflow:hidden;">'+
        '<svg viewBox="0 0 '+W+' '+H+'" width="100%" height="'+H+'" xmlns="http://www.w3.org/2000/svg" style="display:block;">'+
          '<defs><linearGradient id="sg'+vi+'" x1="0" y1="0" x2="0" y2="1"><stop offset="0%" stop-color="#4A3BB5" stop-opacity="0.18"/><stop offset="100%" stop-color="#4A3BB5" stop-opacity="0.02"/></linearGradient></defs>'+
          // min line
          '<line x1="'+PAD+'" y1="'+(H-PAD)+'" x2="'+(W-PAD)+'" y2="'+(H-PAD)+'" stroke="var(--br)" stroke-width="0.5"/>'+
          // area fill
          '<path d="'+areaPath+'" fill="url(#sg'+vi+')" />'+
          // line
          '<polyline points="'+polyPts+'" fill="none" stroke="#4A3BB5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>'+
          // dots for first and last
          '<circle cx="'+PAD+'" cy="'+firstY.toFixed(1)+'" r="3" fill="#4A3BB5"/>'+
          '<circle cx="'+lastX.toFixed(1)+'" cy="'+lastY.toFixed(1)+'" r="3" fill="'+(ts===0?'#E24B4A':'#4A3BB5')+'"/>'+
          // current qty label
          '<text x="'+(lastX+5)+'" y="'+(lastY+4)+'" font-size="10" fill="#4A3BB5" font-family="system-ui,sans-serif" font-weight="500">'+ts+'</text>'+
        '</svg>'+
        // x-axis labels: first, mid, last
        '<div style="display:flex;justify-content:space-between;padding:0 4px;margin-top:2px;">'+
          '<span style="font-size:9px;color:var(--tx3);">'+stockHistory[0].w+'</span>'+
          '<span style="font-size:9px;color:var(--tx3);">'+stockHistory[Math.floor(pts/2)].w+'</span>'+
          '<span style="font-size:9px;color:var(--tx3);">'+stockHistory[pts-1].w+'</span>'+
        '</div>'+
      '</div>'+
    '</div>'+

    // ── Location cards ──
    locHTML(inv.stores,'store','var(--pl)','Retail stores','var(--p)')+
    locHTML(inv.jobbers,'truck','var(--al)','Jobbers and distributors','var(--at)')+
    locHTML(inv.production,'hammer','var(--gl)','Production','var(--gt)')+
    locHTML(inv.warehouse,'box','var(--bl)','Warehouse','var(--bt)')+

    // ── Reservations ──
    '<div style="background:var(--sf);border-radius:var(--rad);margin:7px 12px 0;border:0.5px solid var(--br);overflow:hidden;">'+
      '<div style="display:flex;align-items:center;justify-content:space-between;padding:11px 14px;border-bottom:0.5px solid var(--br);">'+
        '<span style="font-size:13px;font-weight:500;color:var(--tx);">Reservations</span>'+
        '<button onclick="openReserveSheet('+vi+')" style="display:inline-flex;align-items:center;gap:4px;padding:5px 10px;border-radius:6px;background:var(--pl);border:0.5px solid var(--pm);color:var(--pt);font-size:11px;font-weight:500;cursor:pointer;font-family:inherit;">'+ico('plus',12)+' Reserve</button>'+
      '</div>'+
      '<div id="res-list-'+vi+'">'+resRows+'</div>'+
    '</div>'+

    // ── Record movement ──
    '<div style="padding:10px 12px 4px;">'+
      '<button style="width:100%;padding:10px;border-radius:var(--rads);background:var(--p);color:#fff;border:none;font-size:13px;font-weight:500;cursor:pointer;font-family:inherit;" onclick="showToast(\'Opening movement recorder…\')">'+ico('plus',14)+' Record movement</button>'+
    '</div>'
  );
}
function grpKey(title){return title.split(' ')[0].toLowerCase();}

var _reserveVarIdx=null;
function openReserveSheet(vi){
  _reserveVarIdx=vi;
  var v=editMat.variants[vi];
  var inv=v.inventory||{stores:[],jobbers:[],production:[],warehouse:[]};
  function grpTotal(arr){return(arr||[]).reduce(function(s,l){return s+(parseInt(l.qty)||0);},0);}
  var ts=grpTotal(inv.stores)+grpTotal(inv.jobbers)+grpTotal(inv.production)+grpTotal(inv.warehouse);
  var reserved=(v.reservations||[]).reduce(function(s,r){return s+(parseInt(r.qty)||0);},0);
  var available=Math.max(0,ts-reserved);
  document.getElementById('res-order').value='ORD-'+(1000+Math.floor(Math.random()*9000));
  document.getElementById('res-customer').value='';
  document.getElementById('res-qty').value='';
  document.getElementById('res-status').value='confirmed';
  document.getElementById('res-date').value=new Date().toISOString().split('T')[0];
  document.getElementById('res-avail-note').textContent='Available to reserve: '+available+' units ('+ts+' total − '+reserved+' already reserved)';
  openSheet('sh-reserve');
}
function saveReservation(){
  var vi=_reserveVarIdx;if(vi===null)return;
  var order=(document.getElementById('res-order').value||'').trim();
  var customer=(document.getElementById('res-customer').value||'').trim();
  var qty=parseInt(document.getElementById('res-qty').value)||0;
  var status=document.getElementById('res-status').value;
  var date=document.getElementById('res-date').value;
  if(!order){showToast('Enter an order reference');return;}
  if(qty<1){showToast('Enter a quantity to reserve');return;}
  if(!editMat.variants[vi].reservations)editMat.variants[vi].reservations=[];
  editMat.variants[vi].reservations.push({order:order,customer:customer||'—',qty:qty,status:status,date:date});
  closeSheet('sh-reserve');
  // rebuild inventory tab in variant detail if open
  var vp=document.getElementById('vpg-1');
  if(vp&&vp.style.display!=='none')vp.innerHTML=buildVDInventoryHTML(editMat.variants[vi],vi);
  // rebuild supply tab in create/edit if open
  var sp=document.getElementById('cpg-2');
  if(sp&&sp.style.display!=='none')sp.innerHTML=buildSupplyHTML();
  showToast(qty+' units reserved for '+order+' ✓');
}
function removeReservation(vi,ri){
  if(!confirm('Remove this reservation?'))return;
  editMat.variants[vi].reservations.splice(ri,1);
  document.getElementById('vpg-1').innerHTML=buildVDInventoryHTML(editMat.variants[vi],vi);
  showToast('Reservation removed');
}
function adjInvLoc(vi,grp,li,d){
  var inv=editMat.variants[vi].inventory;
  var arr=inv[grp==='retail'?'stores':grp==='jobbers'?'jobbers':grp==='production'?'production':'warehouse'];
  if(!arr)return;
  arr[li].qty=Math.max(0,(parseInt(arr[li].qty)||0)+d);
  var el=document.getElementById('il-'+vi+'-'+grp+'-'+li);
  if(el)el.value=arr[li].qty;
}
function updInvLoc(vi,grp,li,val){
  var inv=editMat.variants[vi].inventory;
  var arr=inv[grp==='retail'?'stores':grp==='jobbers'?'jobbers':grp==='production'?'production':'warehouse'];
  if(arr)arr[li].qty=val;
}

function buildVDTechpackHTML(v,vi){
  var TECHPACKS=[
    {name:'Blue Offshoulder — TP v3',meta:'Updated 23 Apr 2026'},
    {name:'Chatri Aakaar Base — TP v1',meta:'Updated 10 Jan 2026'},
    {name:'Umbrella Cut Dress — TP v2',meta:'Updated 5 Mar 2026'},
  ];
  var linked=v.techpack||'';
  return '<div class="sec" style="margin-top:10px;">'+
    '<div class="sec-hdr"><span class="sec-title">Techpack</span><span class="sec-act" onclick="toggleVDTP()"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg> Link</span></div>'+
    '<div id="vdtp-linked" style="display:'+(linked?'flex':'none')+';align-items:center;gap:8px;padding:10px 14px;background:var(--gl);border-bottom:0.5px solid var(--br);">'+
      '<svg style="font-size:16px;color:var(--gt);" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8zM14 2v6h6M16 13H8M16 17H8M10 9H8"/></svg>'+
      '<span style="flex:1;font-size:13px;color:var(--tx);" id="vdtp-name">'+esc(linked)+'</span>'+
      '<span class="tp-linked-badge">Linked</span>'+
      '<span style="font-size:12px;color:var(--tx3);cursor:pointer;" onclick="unlinkVDTP()"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M18 6L6 18M6 6l12 12"/></svg></span>'+
    '</div>'+
    '<div id="vdtp-empty" style="display:'+(linked?'none':'flex')+';align-items:center;gap:7px;padding:12px 14px;">'+
      '<svg style="font-size:15px;color:var(--tx3);" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 4l16 16M14 2H6a2 2 0 0 0-2 2v3M8 21h10a2 2 0 0 0 2-2V8"/></svg>'+
      '<span style="flex:1;font-size:13px;color:var(--tx3);">No techpack linked</span>'+
      '<span style="font-size:12px;color:var(--p);cursor:pointer;font-weight:500;" onclick="toggleVDTP()">Link from module</span>'+
    '</div>'+
    '<div id="vdtp-dropdown" style="display:none;border-top:0.5px solid var(--br);">'+
      '<div style="padding:7px 14px;font-size:11px;color:var(--tx3);">Your techpacks</div>'+
      TECHPACKS.map(function(tp){return '<div class="tp-item" onclick="linkVDTP(\''+tp.name+'\')"><div class="tp-ico" style="background:var(--pl);"><svg style="color:var(--p);" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8zM14 2v6h6M16 13H8M16 17H8M10 9H8"/></svg></div><div class="tp-info"><div class="tp-name">'+tp.name+'</div><div class="tp-meta">'+tp.meta+'</div></div><svg style="font-size:14px;color:var(--tx3);" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 18l6-6-6-6"/></svg></div>';}).join('')+
      '<div style="padding:10px 14px;"><button style="width:100%;padding:8px;border-radius:var(--rads);background:var(--sf2);border:0.5px dashed var(--br2);color:var(--tx2);font-size:12px;cursor:pointer;font-family:inherit;" onclick="showToast(\'Opening techpack creator…\')"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 5v14M5 12h14"/></svg> Create new techpack</button></div>'+
    '</div>'+
  '</div>'+
  '<div class="sec" style="margin-top:10px;margin-bottom:10px;">'+
    '<div class="sec-hdr"><span class="sec-title">External link</span></div>'+
    '<div class="row-f"><svg style="font-size:15px;color:var(--tx3);margin-right:8px;" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg><input class="rf-inp" type="url" placeholder="Drive, Notion, Dropbox…" value="'+esc(v.externalLink||'')+'"/></div>'+
  '</div>'+
  buildVDCostingHTML(v,vi);
}
function toggleVDTP(){var d=document.getElementById('vdtp-dropdown');if(d)d.style.display=d.style.display==='none'?'block':'none';}
function linkVDTP(name){
  if(curVarIdx!==null)editMat.variants[curVarIdx].techpack=name;
  var ln=document.getElementById('vdtp-linked');var em=document.getElementById('vdtp-empty');var dd=document.getElementById('vdtp-dropdown');var nm=document.getElementById('vdtp-name');
  if(ln)ln.style.display='flex';if(em)em.style.display='none';if(dd)dd.style.display='none';if(nm)nm.textContent=name;
  showToast('Techpack linked');
}
function unlinkVDTP(){
  if(curVarIdx!==null)editMat.variants[curVarIdx].techpack='';
  var ln=document.getElementById('vdtp-linked');var em=document.getElementById('vdtp-empty');
  if(ln)ln.style.display='none';if(em)em.style.display='flex';showToast('Techpack unlinked');
}

function buildVDCostingHTML(v,vi){
  var lines=v.costLines||[{label:'Fabric',val:0},{label:'Labour',val:0},{label:'Packaging',val:0}];
  var total=lines.reduce(function(s,l){return s+(parseFloat(l.val)||0);},0);
  var offer=parseFloat(v.offer)||0;
  var margin=offer>0?Math.round((offer-total)/offer*1000)/10:0;
  var gp=offer-total;
  var linesHTML=lines.map(function(l,li){
    return '<div class="cost-row"><span class="cost-lbl">'+esc(l.label)+'</span><div class="cost-inp-w"><span class="cost-pre">Rs.</span><input class="cost-inp" type="text" value="'+(l.val||0)+'" oninput="updCostLine('+vi+','+li+',parseFloat(this.value)||0)"/></div></div>';
  }).join('');
  return '<div class="sec" style="margin-top:10px;">'+
    '<div class="sec-hdr"><span class="sec-title">Costing</span><span class="sec-act" onclick="addCostLine('+vi+')"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 5v14M5 12h14"/></svg> Add line</span></div>'+
    '<div id="cost-lines-'+vi+'">'+linesHTML+'</div>'+
    '<div class="cost-total-row"><span class="cost-total-lbl">Total cost</span><span class="cost-total-v" id="cost-total-'+vi+'">Rs. '+total.toLocaleString('en-IN')+'</span></div>'+
  '</div>'+
  '<div class="sec" style="margin-top:10px;margin-bottom:10px;">'+
    '<div class="sec-hdr"><span class="sec-title">Margin analysis</span></div>'+
    '<div class="cost-row"><span class="cost-lbl">Offer price</span><span style="font-size:13px;font-weight:500;color:var(--tx);">Rs. '+(offer||0).toLocaleString('en-IN')+'</span></div>'+
    '<div class="cost-row"><span class="cost-lbl">Total cost</span><span style="font-size:13px;color:var(--tx);" id="ma-cost-'+vi+'">Rs. '+total.toLocaleString('en-IN')+'</span></div>'+
    '<div class="cost-row" style="border-bottom:none;"><span class="cost-lbl" style="font-weight:500;">Gross margin</span><span style="font-size:14px;font-weight:500;color:var(--g);" id="ma-gp-'+vi+'">Rs. '+gp.toLocaleString('en-IN')+' ('+margin+'%)</span></div>'+
    '<div class="margin-bar-wrap"><div class="margin-fill" id="ma-bar-'+vi+'" style="width:'+Math.max(0,Math.min(100,margin))+'%;"></div></div>'+
    '<div class="margin-info"><span>Cost: <strong>'+Math.round((100-margin)*10)/10+'%</strong></span><span>Margin: <strong id="ma-pct-'+vi+'">'+margin+'%</strong></span></div>'+
  '</div>';
}
function updCostLine(vi,li,val){
  editMat.variants[vi].costLines[li].val=val;
  var lines=editMat.variants[vi].costLines;
  var total=lines.reduce(function(s,l){return s+(parseFloat(l.val)||0);},0);
  var offer=parseFloat(editMat.variants[vi].offer)||0;
  var margin=offer>0?Math.round((offer-total)/offer*1000)/10:0;
  var gp=offer-total;
  var te=document.getElementById('cost-total-'+vi);if(te)te.textContent='Rs. '+total.toLocaleString('en-IN');
  var mc=document.getElementById('ma-cost-'+vi);if(mc)mc.textContent='Rs. '+total.toLocaleString('en-IN');
  var mg=document.getElementById('ma-gp-'+vi);if(mg)mg.textContent='Rs. '+gp.toLocaleString('en-IN')+' ('+margin+'%)';
  var bar=document.getElementById('ma-bar-'+vi);if(bar)bar.style.width=Math.max(0,Math.min(100,margin))+'%';
  var mp=document.getElementById('ma-pct-'+vi);if(mp)mp.textContent=margin+'%';
}
function addCostLine(vi){
  var label=prompt('Cost line name:');if(!label)return;
  if(!editMat.variants[vi].costLines)editMat.variants[vi].costLines=[];
  editMat.variants[vi].costLines.push({label:label,val:0});
  var el=document.getElementById('cost-lines-'+vi);
  if(!el)return;
  var li=editMat.variants[vi].costLines.length-1;
  var div=document.createElement('div');div.className='cost-row';
  div.innerHTML='<span class="cost-lbl">'+esc(label)+'</span><div class="cost-inp-w"><span class="cost-pre">Rs.</span><input class="cost-inp" type="text" value="0" oninput="updCostLine('+vi+','+li+',parseFloat(this.value)||0)"/></div>';
  el.appendChild(div);
}

function saveVD(){
  var vi=curVarIdx;if(vi===null)return;
  var v=editMat.variants[vi];
  if(document.getElementById('vd-name'))v.name=document.getElementById('vd-name').value;
  if(document.getElementById('vd-sku'))v.sku=document.getElementById('vd-sku').value;
  if(document.getElementById('vd-bc-inp'))v.barcode=document.getElementById('vd-bc-inp').value;
  if(document.getElementById('vd-mrp'))v.mrp=parseFloat(document.getElementById('vd-mrp').value)||0;
  if(document.getElementById('vd-offer'))v.offer=parseFloat(document.getElementById('vd-offer').value)||0;
  if(document.getElementById('vd-cost'))v.cost=parseFloat(document.getElementById('vd-cost').value)||0;
  if(document.getElementById('vd-minqty'))v.minqty=parseInt(document.getElementById('vd-minqty').value)||0;
  showToast('Variant saved');goBack();
  setTimeout(function(){document.getElementById('cpg-0').innerHTML=buildInfoHTML();},100);
}

// ═══════════════════════════════
//  BARCODE
// ═══════════════════════════════
function renderBCCanvas(val,canvasId,lblId){
  var canvas=document.getElementById(canvasId);var lbl=document.getElementById(lblId);
  if(!canvas)return;
  if(lbl)lbl.textContent=val||'';
  var ctx=canvas.getContext('2d');
  var W=canvas.width,H=canvas.height;
  ctx.fillStyle=getComputedStyle(document.documentElement).getPropertyValue('--sf').trim()||'#fff';
  ctx.fillRect(0,0,W,H);
  if(!val)return;
  var chars=val.split('');
  var bw=Math.max(2,Math.floor((W-16)/(chars.length*11)));
  var x=8;ctx.fillStyle='#1A1740';
  chars.forEach(function(ch){var code=ch.charCodeAt(0);for(var b=0;b<8;b++){if(code&(1<<(7-b)))ctx.fillRect(x+b*bw,5,bw-1,H-12);}x+=11*bw;});
}
function downloadBC(canvasId,val){
  var c=document.getElementById(canvasId);if(!c)return;
  var a=document.createElement('a');a.download=(val||'barcode')+'.png';a.href=c.toDataURL();a.click();
}
function copyBC(val){if(navigator.clipboard)navigator.clipboard.writeText(val);showToast('Copied: '+val);}

// ═══════════════════════════════
//  TAG SHEET
// ═══════════════════════════════
// ═══════════════════════════════
//  VARIANT IMAGE MANAGER
// ═══════════════════════════════
var _varImgIdx=null;

function openVarImgSheet(vi){
  _varImgIdx=vi;
  var v=editMat.variants[vi];
  document.getElementById('sh-varimg-title').textContent=(v.name||'Variant '+(vi+1))+' — Images';
  renderVarImgSheet(vi);
  openSheet('sh-varimg');
}

function renderVarImgSheet(vi){
  var v=editMat.variants[vi];
  var varImgs=v.images||[];
  var prodImgs=editMat.imgs||[];

  // ── variant's own images ──
  var ownGrid=document.getElementById('vi-own-grid');
  if(ownGrid){
    ownGrid.innerHTML=varImgs.length?varImgs.map(function(src,idx){
      var isCover=idx===0;
      return '<div style="position:relative;aspect-ratio:1;border-radius:8px;overflow:hidden;border:2px solid '+(isCover?'var(--p)':'var(--br)')+';cursor:pointer;" onclick="setVarCover('+vi+','+idx+')" oncontextmenu="event.preventDefault();removeVarImg('+vi+','+idx+')">'+
        '<img src="'+src+'" style="width:100%;height:100%;object-fit:cover;" alt=""/>'+
        (isCover?'<div style="position:absolute;bottom:0;left:0;right:0;background:var(--p);color:#fff;font-size:9px;font-weight:500;text-align:center;padding:2px 0;">Cover</div>':'')+
        '<button onclick="event.stopPropagation();removeVarImg('+vi+','+idx+')" style="position:absolute;top:4px;right:4px;width:18px;height:18px;border-radius:50%;background:rgba(0,0,0,0.55);border:none;color:#fff;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:11px;line-height:1;">×</button>'+
      '</div>';
    }).join(''):'<div style="grid-column:1/-1;padding:14px 0;text-align:center;font-size:13px;color:var(--tx3);">No images for this variant yet</div>';
  }

  // ── product gallery ──
  var galGrid=document.getElementById('vi-gallery-grid');
  var galEmpty=document.getElementById('vi-gallery-empty');
  if(galGrid){
    if(!prodImgs.length){
      galGrid.innerHTML='';
      if(galEmpty)galEmpty.style.display='block';
    } else {
      if(galEmpty)galEmpty.style.display='none';
      galGrid.innerHTML=prodImgs.map(function(src,idx){
        var tagged=varImgs.includes(src);
        return '<div style="position:relative;aspect-ratio:1;border-radius:8px;overflow:hidden;border:2px solid '+(tagged?'var(--p)':'var(--br)')+';cursor:pointer;" onclick="toggleGalleryTag('+vi+','+idx+')">'+
          '<img src="'+src+'" style="width:100%;height:100%;object-fit:cover;opacity:'+(tagged?'1':'0.65')+';" alt=""/>'+
          (tagged?'<div style="position:absolute;top:4px;right:4px;width:18px;height:18px;border-radius:50%;background:var(--p);display:flex;align-items:center;justify-content:center;"><svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg></div>':
           '<div style="position:absolute;top:4px;right:4px;width:18px;height:18px;border-radius:50%;background:rgba(0,0,0,0.3);display:flex;align-items:center;justify-content:center;"><svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14M5 12h14"/></svg></div>')+
        '</div>';
      }).join('');
    }
  }
}

function handleVarImgUpload(inp){
  var vi=_varImgIdx;if(vi===null)return;
  Array.from(inp.files).forEach(function(f){
    var r=new FileReader();
    r.onload=function(e){
      if(!editMat.variants[vi].images)editMat.variants[vi].images=[];
      editMat.variants[vi].images.push(e.target.result);
      renderVarImgSheet(vi);
      rebuildVariantsPage();
    };
    r.readAsDataURL(f);
  });
  inp.value='';
}

function toggleGalleryTag(vi,prodImgIdx){
  var src=editMat.imgs[prodImgIdx];
  if(!src)return;
  if(!editMat.variants[vi].images)editMat.variants[vi].images=[];
  var imgs=editMat.variants[vi].images;
  var i=imgs.indexOf(src);
  if(i>-1)imgs.splice(i,1);else imgs.unshift(src);
  renderVarImgSheet(vi);
  rebuildVariantsPage();
  showToast(i>-1?'Image untagged':'Image tagged to variant');
}

function setVarCover(vi,imgIdx){
  var imgs=editMat.variants[vi].images;
  if(!imgs||imgIdx===0)return;
  var cover=imgs.splice(imgIdx,1)[0];
  imgs.unshift(cover);
  renderVarImgSheet(vi);
  rebuildVariantsPage();
  showToast('Set as cover image');
}

function removeVarImg(vi,imgIdx){
  editMat.variants[vi].images.splice(imgIdx,1);
  renderVarImgSheet(vi);
  rebuildVariantsPage();
  showToast('Image removed');
}

function openTagSheet(vi){
  curTagVarIdx=vi;
  var v=editMat.variants[vi];
  document.getElementById('sh-tag-name').textContent=v.name||'Variant '+(vi+1);
  document.querySelectorAll('#sh-color-chips .schip,#sh-sz-chips .schip').forEach(function(c){c.classList.remove('on','col','sz');});
  (v.tags||[]).forEach(function(t){document.querySelectorAll('.sh-ov .schip').forEach(function(c){if(c.textContent.trim()===t.label)c.classList.add('on',t.style==='color-s'?'col':'sz');});});
  openSheet('sh-tag');
}
function toggleChip(el,cls){el.classList.toggle('on');if(el.classList.contains('on'))el.classList.add(cls);else el.classList.remove(cls);}
function addCustomTag(){var inp=document.getElementById('ctag-inp');var val=(inp.value||'').trim();if(!val)return;var ch=document.getElementById('sh-color-chips');var d=document.createElement('div');d.className='schip col on';d.textContent=val;d.onclick=function(){toggleChip(this,'col');};ch.appendChild(d);inp.value='';}

// ═══════════════════════════════
//  LINKS TAB HELPERS
// ═══════════════════════════════
function toggleTPDropdown(){var d=document.getElementById('tp-dropdown');if(d)d.style.display=d.style.display==='none'?'block':'none';}
function linkTP(name){
  editMat.techpack=name;
  var ln=document.getElementById('tp-linked');var em=document.getElementById('tp-empty');var dd=document.getElementById('tp-dropdown');
  if(ln){ln.style.display='flex';var nm=ln.querySelector('span');if(nm)nm.textContent=name;}
  if(em)em.style.display='none';if(dd)dd.style.display='none';
  showToast('Techpack linked');
}
function unlinkTP(){editMat.techpack='';var ln=document.getElementById('tp-linked');var em=document.getElementById('tp-empty');if(ln)ln.style.display='none';if(em)em.style.display='flex';showToast('Techpack unlinked');}
function handleTPUpload(inp){if(!inp.files||!inp.files[0])return;var f=inp.files[0];showToast('Uploaded: '+f.name+' (upload to server coming soon)');}

// ═══════════════════════════════
//  BULK APPLY
// ═══════════════════════════════
function applyAll(type){
  closeSheet('sh-bulk');
  var msgs={pricing:'MRP and offer price applied to all variants',images:'Images applied to all variants',stock:'Opening stock set for all variants',barcode:'Barcodes auto-generated for all variants',minqty:'Min quantity applied to all variants'};
  showToast(msgs[type]||'Applied to all variants');
  if(type==='barcode'&&editMat.variants){editMat.variants.forEach(function(v){v.barcode=v.sku||v.name;});}
}

// ═══════════════════════════════
//  AI
// ═══════════════════════════════
var AI_SUGS=['A beautifully crafted finished garment for festive and everyday wear. Available in multiple sizes — built for comfort and timeless elegance.','Handcrafted with premium fabric, combining traditional aesthetics with modern silhouettes. Perfect for boutique collections.','An exclusive design celebrating artisan craftsmanship. Available in a range of sizes, ideal for retail and made-to-order collections.'];
function triggerAI(){var b=document.getElementById('ai-gen');if(!b)return;b.style.display='block';document.getElementById('ai-gen-text').textContent=AI_SUGS[Math.floor(Math.random()*AI_SUGS.length)];}
function useAI(){var t=document.getElementById('ai-gen-text');var d=document.getElementById('f-desc');if(t&&d){d.value=t.textContent;upChars();}document.getElementById('ai-gen').style.display='none';}
function upChars(){var d=document.getElementById('f-desc');var c=document.getElementById('desc-chars');if(d&&c)c.textContent=d.value.length+' chars';}

// ═══════════════════════════════
//  IMAGES
// ═══════════════════════════════
function handleImgs(inp){Array.from(inp.files).forEach(function(f){var r=new FileReader();r.onload=function(e){uploadedImgs.push(e.target.result);editMat.imgs=uploadedImgs.slice();renderImgPreviews();};r.readAsDataURL(f);});inp.value='';}
function renderImgPreviews(){var el=document.getElementById('img-previews');if(!el)return;el.innerHTML=uploadedImgs.map(function(s,i){return '<div class="img-thumb'+(i===0?' featured':'')+'"><img src="'+s+'" alt=""/><button class="img-del" onclick="removeImg('+i+')">×</button></div>';}).join('');}
function removeImg(idx){uploadedImgs.splice(idx,1);editMat.imgs=uploadedImgs.slice();renderImgPreviews();}

// ═══════════════════════════════
//  SYNC
// ═══════════════════════════════
function downloadCSV(){
  var rows=['Material ID,Material Name,Variant Name,SKU,Barcode,Current Qty,New Qty'];
  materials.forEach(function(m){m.variants.forEach(function(v){rows.push([m.id,'"'+m.name+'"','"'+v.name+'"',v.sku,v.barcode||'',parseInt(v.qty)||0,''].join(','));});});
  var blob=new Blob([rows.join('\n')],{type:'text/csv'});
  var a=document.createElement('a');a.href=URL.createObjectURL(blob);a.download='boutiqbiz_inventory_'+new Date().toISOString().slice(0,10)+'.csv';a.click();
  showToast('Downloading inventory.csv');
}
function handleSync(inp){
  var file=inp.files[0];if(!file)return;
  var reader=new FileReader();
  reader.onload=function(e){
    var lines=e.target.result.split('\n').slice(1).filter(function(l){return l.trim();});
    var parsed=[];
    lines.forEach(function(line){
      var cols=(line.match(/(".*?"|[^,]+)(?=,|$)/g)||[]).map(function(c){return c.replace(/^"|"$/g,'').trim();});
      if(cols.length>=7&&cols[6]!=='')parsed.push({mid:parseInt(cols[0]),sku:cols[3],newQty:parseInt(cols[6])||0,name:cols[2]});
    });
    showSyncPrev(parsed);
  };
  reader.readAsText(file);inp.value='';
}
function showSyncPrev(rows){
  document.getElementById('sync-prev').style.display='block';
  document.getElementById('sync-prev-title').textContent=rows.length+' rows to update';
  var html='';
  rows.forEach(function(r){
    var m=materials.find(function(x){return x.id===r.mid;});
    var v=m?m.variants.find(function(x){return x.sku===r.sku;}):null;
    var cur=v?parseInt(v.qty)||0:'?';var diff=v?(r.newQty-(parseInt(v.qty)||0)):'?';
    var cls=diff>0?'var(--g)':diff<0?'var(--r)':'var(--tx2)';
    html+='<div class="sync-prev-row"><div><div style="font-size:13px;font-weight:500;">'+esc(r.name)+'</div><div style="font-size:10px;color:var(--tx3);font-family:monospace;">'+esc(r.sku)+'</div></div>'+
      '<div style="text-align:right;"><div style="font-size:12px;color:var(--tx2);">'+cur+' → '+r.newQty+'</div><div style="font-size:11px;font-weight:500;color:'+cls+';">'+(diff>0?'+':'')+diff+'</div></div></div>';
  });
  document.getElementById('sync-prev-rows').innerHTML=html;
  window._syncRows=rows;
}
function confirmSync(){
  (window._syncRows||[]).forEach(function(r){var m=materials.find(function(x){return x.id===r.mid;});if(m){var v=m.variants.find(function(x){return x.sku===r.sku;});if(v)v.qty=r.newQty;}});
  showToast('Synced '+( window._syncRows||[]).length+' variants ✓');
  document.getElementById('sync-prev').style.display='none';
}

// ═══════════════════════════════
//  SHOPIFY
// ═══════════════════════════════
function runShopifyImport(){
  var url=document.getElementById('shopify-url').value.trim();
  var token=document.getElementById('shopify-token').value.trim();
  if(!url||!token){showToast('Enter store URL and token');return;}
  var prog=document.getElementById('shopify-prog');var bar=document.getElementById('shopify-bar');var txt=document.getElementById('shopify-txt');
  prog.style.display='block';
  var steps=['Connecting…','Fetching products…','Importing variants…','Syncing images…','Done — 4 products imported ✓'];
  var pcts=[10,35,65,85,100];var i=0;
  var iv=setInterval(function(){bar.style.width=pcts[i]+'%';txt.textContent=steps[i];i++;
    if(i>=steps.length){clearInterval(iv);setTimeout(function(){
      closeSheet('sh-shopify');
      materials.unshift({id:Date.now(),name:'Shopify: Summer Printed Kurti',type:'finished',sku:'SHO-KURTI-S',vendors:[{name:'Shopify Import',type:'primary',lead:'',contact:''}],imgs:[],desc:'Imported from Shopify',notes:'',techpack:'',cats:[],
        variants:[{name:'Default',sku:'SHO-KURTI-S',mrp:1500,offer:1200,cost:600,qty:8,barcode:'SHO-KURTI-S',minqty:2,color:'#185FA5',tags:[],images:[],notes:'',costLines:[],inventory:{stores:[{loc:'VB Asansol',qty:8,color:'#185FA5'}],jobbers:[],production:[],warehouse:[]}}]
      });
      renderList();showToast('4 products imported from Shopify ✓');
    },600);}
  },600);
}

// ═══════════════════════════════
//  SHEETS
// ═══════════════════════════════
function openSheet(id){document.getElementById(id).classList.add('open');}
function closeSheet(id){
  if(id==='sh-tag'&&curTagVarIdx!==null){
    var tags=[];
    document.querySelectorAll('#sh-color-chips .schip.on').forEach(function(c){tags.push({label:c.textContent.trim(),style:'color-s'});});
    document.querySelectorAll('#sh-sz-chips .schip.on').forEach(function(c){tags.push({label:c.textContent.trim(),style:'size-s'});});
    editMat.variants[curTagVarIdx].tags=tags;
    rebuildVariantsPage();
  }
  document.getElementById(id).classList.remove('open');
}

// ═══════════════════════════════
//  UTIL
// ═══════════════════════════════
function esc(s){return String(s||'').replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');}
var _toast=null;
function showToast(msg){var t=document.getElementById('toast');t.textContent=msg;t.classList.add('show');if(_toast)clearTimeout(_toast);_toast=setTimeout(function(){t.classList.remove('show');},2400);}

// ═══════════════════════════════
//  INIT
// ═══════════════════════════════
renderCustomTabs();
renderList();
</script>

<!-- ══════════════ LABEL PRINTING — BoutiqBiz v5 ══════════════ -->

<!-- s-labels screen -->
<div class="screen" id="s-labels">
  <div class="tb">
    <button class="tb-bk" onclick="goBack()"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 5l-7 7 7 7"/></svg></button>
    <div class="tb-info"><div class="tb-title">Print Labels</div></div>
    <div class="tb-acts">
      <button class="tbb white" onclick="openAddLabelSheet()">+ Add</button>
    </div>
  </div>
  <div class="tab-strip">
    <div class="tab-inner">
      <div class="tab on" id="ltab-0" onclick="setLTab(0)">Queue</div>
      <div class="tab" id="ltab-1" onclick="setLTab(1)">Designs</div>
      <div class="tab" id="ltab-2" onclick="setLTab(2)">Clients</div>
    </div>
  </div>
  <div class="screen-body" style="padding:0;">
    <div id="lpg-0" style="display:block;">
      <div style="padding:10px 12px 4px;display:flex;align-items:center;justify-content:space-between;">
        <span style="font-size:13px;color:var(--tx2);" id="lq-count">0 items in queue</span>
        <div style="display:flex;gap:8px;">
          <button onclick="clearLabelQueue()" style="font-size:12px;color:var(--r);background:none;border:none;cursor:pointer;font-family:inherit;">Clear all</button>
          <button onclick="printLabelQueue()" style="display:inline-flex;align-items:center;gap:5px;padding:6px 14px;background:var(--p);color:#fff;border:none;border-radius:var(--rads);font-size:13px;font-weight:500;cursor:pointer;font-family:inherit;"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg> Print All</button>
        </div>
      </div>
      <div id="label-queue-list" style="padding:0 12px 80px;"></div>
    </div>
    <div id="lpg-1" style="display:none;padding:12px 12px 80px;">
      <button onclick="openLabelDesignEdit(null)" style="width:100%;padding:10px;border-radius:var(--rads);background:var(--sf2);border:0.5px dashed var(--br2);color:var(--p);font-size:13px;font-weight:500;cursor:pointer;font-family:inherit;margin-bottom:12px;display:flex;align-items:center;justify-content:center;gap:6px;"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14M5 12h14"/></svg> New Design</button>
      <div id="label-designs-list"></div>
    </div>
    <div id="lpg-2" style="display:none;padding:12px 12px 80px;">
      <button onclick="openClientLabelSheet(null)" style="width:100%;padding:10px;border-radius:var(--rads);background:var(--sf2);border:0.5px dashed var(--br2);color:var(--p);font-size:13px;font-weight:500;cursor:pointer;font-family:inherit;margin-bottom:12px;display:flex;align-items:center;justify-content:center;gap:6px;"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14M5 12h14"/></svg> New Client Config</button>
      <div id="label-clients-list"></div>
    </div>
  </div>
</div>

<!-- s-label-preview screen -->
<div class="screen" id="s-label-preview">
  <div class="tb">
    <button class="tb-bk" onclick="goBack()"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 5l-7 7 7 7"/></svg></button>
    <div class="tb-info"><div class="tb-title">Print Preview</div></div>
    <div class="tb-acts">
      <button class="tbb white" onclick="window.print()" style="display:inline-flex;align-items:center;gap:5px;"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg> Print</button>
    </div>
  </div>
  <div class="screen-body" style="padding:12px;background:var(--sf2);">
    <div style="margin-bottom:10px;display:flex;align-items:center;gap:8px;flex-wrap:wrap;">
      <span style="font-size:12px;color:var(--tx2);">Paper:</span>
      <select id="prev-paper" onchange="buildPrintPreview()" style="padding:5px 8px;border-radius:6px;border:0.5px solid var(--br2);font-size:12px;font-family:inherit;background:var(--sf);">
        <option>A4</option><option>A5</option><option>Thermal 80mm</option><option>Label sheet</option>
      </select>
      <span style="font-size:12px;color:var(--tx2);">Copies per item:</span>
      <input id="prev-copies" type="number" value="1" min="1" max="100" onchange="buildPrintPreview()" style="width:50px;padding:5px 8px;border-radius:6px;border:0.5px solid var(--br2);font-size:12px;font-family:inherit;">
    </div>
    <div id="print-area" style="background:#fff;border-radius:8px;border:0.5px solid var(--br);overflow:hidden;min-height:200px;"></div>
  </div>
</div>

<!-- sh-addlabel sheet -->
<div class="sh-ov" id="sh-addlabel" onclick="if(event.target===this)closeSheet('sh-addlabel')">
  <div class="sh">
    <div class="sh-hdl"></div>
    <div class="sh-top">
      <span class="sh-main-title">Add to Print Queue</span>
      <button class="sh-close" onclick="closeSheet('sh-addlabel')"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6L6 18M6 6l12 12"/></svg></button>
    </div>
    <div class="sh-main" style="padding:12px 16px 30px;overflow-y:auto;max-height:78vh;">
      <div class="lbl" style="margin-bottom:4px;">Find material</div>
      <div style="position:relative;margin-bottom:8px;">
        <input id="al-search" class="inp" type="text" placeholder="Search by name or SKU…" oninput="searchAddLabel(this.value)" style="padding-left:32px;"/>
        <svg style="position:absolute;left:10px;top:50%;transform:translateY(-50%);color:var(--tx3);" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
      </div>
      <div id="al-results" style="max-height:140px;overflow-y:auto;border:0.5px solid var(--br);border-radius:var(--rad);margin-bottom:12px;min-height:40px;"></div>
      <div id="al-variant-section" style="display:none;">
        <div class="lbl" style="margin-bottom:4px;">Select variant</div>
        <select id="al-variant" class="inp" onchange="updateALVariant()" style="margin-bottom:12px;"></select>
      </div>
      <div class="lbl" style="margin-bottom:4px;">Label design</div>
      <div id="al-design-pills" style="display:flex;flex-wrap:wrap;gap:6px;margin-bottom:12px;"></div>
      <div class="lbl" style="margin-bottom:4px;">Quantity</div>
      <div style="display:flex;align-items:center;gap:10px;margin-bottom:12px;">
        <button onclick="adjALQty(-1)" style="width:36px;height:36px;border-radius:50%;border:0.5px solid var(--br2);background:var(--sf2);font-size:20px;cursor:pointer;display:flex;align-items:center;justify-content:center;font-family:inherit;">−</button>
        <input id="al-qty" class="inp" type="number" value="1" min="1" style="width:70px;text-align:center;font-size:18px;font-weight:500;"/>
        <button onclick="adjALQty(1)" style="width:36px;height:36px;border-radius:50%;border:0.5px solid var(--br2);background:var(--sf2);font-size:20px;cursor:pointer;display:flex;align-items:center;justify-content:center;font-family:inherit;">+</button>
      </div>
      <div id="al-custom-fields-section" style="display:none;">
        <div class="lbl" style="margin-bottom:6px;">Custom fields for this print</div>
        <div id="al-custom-fields"></div>
      </div>
      <button onclick="addToLabelQueue()" style="width:100%;padding:12px;background:var(--p);color:#fff;border:none;border-radius:var(--rads);font-size:14px;font-weight:500;cursor:pointer;font-family:inherit;margin-top:4px;">Add to Queue</button>
    </div>
  </div>
</div>

<!-- sh-label-design-edit sheet -->
<div class="sh-ov" id="sh-label-design-edit" onclick="if(event.target===this)closeSheet('sh-label-design-edit')">
  <div class="sh" style="max-height:95vh;">
    <div class="sh-hdl"></div>
    <div class="sh-top">
      <span class="sh-main-title" id="lde-title">New Label Design</span>
      <button class="sh-close" onclick="closeSheet('sh-label-design-edit')"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6L6 18M6 6l12 12"/></svg></button>
    </div>
    <div class="sh-main" style="padding:12px 16px 30px;overflow-y:auto;max-height:82vh;">
      <div class="lbl" style="margin-bottom:4px;">Design name</div>
      <input id="lde-name" class="inp" type="text" placeholder="e.g. Reliance Trends 50×30" style="margin-bottom:12px;"/>
      <div class="lbl" style="margin-bottom:4px;">Label size</div>
      <div style="display:flex;flex-wrap:wrap;gap:6px;margin-bottom:12px;" id="lde-size-pills">
        <button class="val-chip size-s on" onclick="selectLabelSize(this,'50x30')">50×30mm</button>
        <button class="val-chip size-s" onclick="selectLabelSize(this,'40x25')">40×25mm</button>
        <button class="val-chip size-s" onclick="selectLabelSize(this,'80x50')">80×50mm</button>
        <button class="val-chip size-s" onclick="selectLabelSize(this,'100x60')">100×60mm</button>
        <button class="val-chip size-s" onclick="selectLabelSize(this,'A6')">A6 (105×148mm)</button>
        <button class="val-chip size-s" onclick="selectLabelSize(this,'custom')">Custom…</button>
      </div>
      <div id="lde-custom-size" style="display:none;gap:8px;margin-bottom:12px;">
        <input id="lde-w" class="inp" type="number" placeholder="Width mm" style="width:48%;display:inline-block;"/>
        <input id="lde-h" class="inp" type="number" placeholder="Height mm" style="width:48%;display:inline-block;margin-left:4%;"/>
      </div>
      <div class="lbl" style="margin-bottom:4px;">Fields to include</div>
      <div id="lde-fields" style="display:grid;grid-template-columns:1fr 1fr;gap:6px;margin-bottom:12px;"></div>
      <div class="lbl" style="margin-bottom:4px;">Custom fields</div>
      <div id="lde-custom-fields-list" style="margin-bottom:6px;"></div>
      <button onclick="addLDECustomField()" style="width:100%;padding:8px;border-radius:var(--rads);background:var(--sf2);border:0.5px dashed var(--br2);color:var(--tx2);font-size:12px;cursor:pointer;font-family:inherit;margin-bottom:12px;">+ Add custom field</button>
      <div class="lbl" style="margin-bottom:4px;">Orientation</div>
      <div style="display:flex;gap:8px;margin-bottom:12px;">
        <button class="val-chip size-s on" id="lde-portrait" onclick="selectOrientation(this,'portrait')">Portrait</button>
        <button class="val-chip size-s" id="lde-landscape" onclick="selectOrientation(this,'landscape')">Landscape</button>
      </div>
      <div class="lbl" style="margin-bottom:4px;">Barcode type</div>
      <div style="display:flex;gap:8px;flex-wrap:wrap;margin-bottom:12px;" id="lde-bc-pills">
        <button class="val-chip size-s on" onclick="selectBCType(this,'CODE128')">Code 128</button>
        <button class="val-chip size-s" onclick="selectBCType(this,'EAN13')">EAN-13</button>
        <button class="val-chip size-s" onclick="selectBCType(this,'QR')">QR Code</button>
        <button class="val-chip size-s" onclick="selectBCType(this,'none')">None</button>
      </div>
      <div class="lbl" style="margin-bottom:4px;">Live preview</div>
      <div id="lde-preview" style="background:#fff;border:1px solid var(--br);border-radius:8px;overflow:hidden;min-height:100px;display:flex;align-items:center;justify-content:center;margin-bottom:16px;padding:8px;"></div>
      <button onclick="saveLabelDesign()" style="width:100%;padding:12px;background:var(--p);color:#fff;border:none;border-radius:var(--rads);font-size:14px;font-weight:500;cursor:pointer;font-family:inherit;">Save Design</button>
    </div>
  </div>
</div>

<!-- sh-client-label sheet -->
<div class="sh-ov" id="sh-client-label" onclick="if(event.target===this)closeSheet('sh-client-label')">
  <div class="sh">
    <div class="sh-hdl"></div>
    <div class="sh-top">
      <span class="sh-main-title" id="cl-title">Client Label Config</span>
      <button class="sh-close" onclick="closeSheet('sh-client-label')"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6L6 18M6 6l12 12"/></svg></button>
    </div>
    <div class="sh-main" style="padding:12px 16px 30px;overflow-y:auto;max-height:78vh;">
      <input type="hidden" id="cl-id"/>
      <div class="lbl" style="margin-bottom:4px;">Client name</div>
      <input id="cl-name" class="inp" type="text" placeholder="e.g. Reliance Trends" style="margin-bottom:12px;"/>
      <div class="lbl" style="margin-bottom:4px;">Default label design</div>
      <select id="cl-design" class="inp" style="margin-bottom:12px;"></select>
      <div class="lbl" style="margin-bottom:4px;">Client-specific fields</div>
      <div id="cl-custom-fields" style="margin-bottom:6px;"></div>
      <button onclick="addCLField()" style="width:100%;padding:8px;border-radius:var(--rads);background:var(--sf2);border:0.5px dashed var(--br2);color:var(--tx2);font-size:12px;cursor:pointer;font-family:inherit;margin-bottom:12px;">+ Add field</button>
      <div class="lbl" style="margin-bottom:4px;">Notes / special instructions</div>
      <textarea id="cl-notes" class="inp" rows="3" placeholder="e.g. Must include price tag, barcode at 300dpi…" style="resize:vertical;margin-bottom:16px;"></textarea>
      <button onclick="saveClientConfig()" style="width:100%;padding:12px;background:var(--p);color:#fff;border:none;border-radius:var(--rads);font-size:14px;font-weight:500;cursor:pointer;font-family:inherit;">Save Client Config</button>
    </div>
  </div>
</div>

<style>
@media print{
  body>*:not(#s-label-preview){display:none!important;}
  #s-label-preview{display:block!important;position:static!important;}
  #s-label-preview .hdr,#s-label-preview>div>div:first-child{display:none!important;}
  #print-area{border:none!important;border-radius:0!important;}
  .print-label{page-break-inside:avoid;}
}
.ld-card{background:var(--sf);border-radius:var(--rad);border:0.5px solid var(--br);margin-bottom:8px;overflow:hidden;}
.ld-hdr{display:flex;align-items:center;padding:12px 14px;gap:10px;}
.ld-ico{width:36px;height:36px;border-radius:8px;background:var(--pl);display:flex;align-items:center;justify-content:center;color:var(--p);flex-shrink:0;}
.ld-info{flex:1;min-width:0;}
.ld-name{font-size:14px;font-weight:500;color:var(--tx);margin-bottom:2px;}
.ld-meta{font-size:11px;color:var(--tx3);}
.ld-acts{display:flex;gap:6px;}
.ld-act{padding:5px 10px;border-radius:6px;font-size:11px;font-weight:500;cursor:pointer;border:0.5px solid var(--br2);background:var(--sf2);color:var(--tx2);font-family:inherit;}
.lq-item{background:var(--sf);border-radius:var(--rad);border:0.5px solid var(--br);margin-bottom:8px;padding:12px 14px;display:flex;align-items:center;gap:10px;}
.lq-thumb{width:40px;height:40px;border-radius:6px;background:var(--pl);display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:600;color:var(--p);flex-shrink:0;overflow:hidden;}
.lq-info{flex:1;min-width:0;}
.lq-name{font-size:13px;font-weight:500;color:var(--tx);margin-bottom:2px;}
.lq-sub{font-size:11px;color:var(--tx3);}
.lq-qty-badge{background:var(--pl);color:var(--pt);font-size:12px;font-weight:600;padding:4px 10px;border-radius:20px;flex-shrink:0;}
.print-label{display:inline-flex;flex-direction:column;border:0.5px solid #ccc;border-radius:4px;overflow:hidden;margin:4px;vertical-align:top;font-family:'Helvetica Neue',Arial,sans-serif;background:#fff;}

/* ─ VIEW MODES ─ */
.view-toggle{display:flex;gap:3px;}
.vtb{width:30px;height:30px;display:flex;align-items:center;justify-content:center;border-radius:6px;border:none;cursor:pointer;background:transparent;color:var(--tx3);flex-shrink:0;}
.vtb.on{background:rgba(255,255,255,0.22);color:#fff;}
/* gallery 2-col */
.view-gallery #mat-list{display:grid;grid-template-columns:1fr 1fr;gap:10px;padding:10px 12px 16px;}
.view-gallery .mat-card{margin:0;border-radius:12px;}
.view-gallery .mrow{flex-direction:column;align-items:flex-start;padding:0;cursor:pointer;}
.view-gallery .mth{width:100%;height:140px;border-radius:12px 12px 0 0;border:none;}
.view-gallery .mi{padding:9px 10px 8px;width:100%;}
.view-gallery .mexp,.view-gallery .mqw{display:none;}
.view-gallery .vlist{display:none;}
.view-gallery .mnrow{flex-wrap:wrap;gap:4px;}
/* large card */
.view-large #mat-list{display:flex;flex-direction:column;gap:12px;padding:12px 12px 16px;}
.view-large .mat-card{margin:0;border-radius:14px;}
.view-large .mrow{flex-direction:column;align-items:flex-start;padding:0;cursor:pointer;}
.view-large .mth{width:100%;height:180px;min-height:180px;border-radius:14px 14px 0 0;border:none;background:linear-gradient(145deg,var(--sf2),var(--pl));display:flex;align-items:center;justify-content:center;overflow:hidden;}
.view-large .mth img{width:100%;height:100%;object-fit:cover;display:block;}
.view-large .mth svg{opacity:0.3;width:48px;height:48px;}
.view-large .mi{padding:12px 14px 10px;width:100%;}
.view-large .mname{font-size:15px;}
.view-large .msub{font-size:12px;margin-top:3px;}
.view-large .mexp,.view-large .mqw{display:none;}
.view-large .mqty-lg{font-size:16px;font-weight:600;margin-top:8px;}
/* ─ COLLAPSIBLE NAV ─ */
.nav-sec-hdr{display:flex;align-items:center;gap:8px;padding:10px 18px 6px;font-size:10px;font-weight:700;color:var(--tx3);text-transform:uppercase;letter-spacing:0.5px;cursor:pointer;user-select:none;transition:background 0.12s;}
.nav-sec-hdr:hover{background:var(--sf2);}
.nav-sec-hdr .chev{margin-left:auto;transition:transform 0.2s;flex-shrink:0;}
.nav-sec-hdr.collapsed .chev{transform:rotate(-90deg);}
.nav-sec-body{overflow:hidden;transition:max-height 0.25s ease,opacity 0.2s;}
.nav-sec-body.collapsed{max-height:0!important;opacity:0;}
/* ─ ADVANCED FILTER ─ */
.fp-search{display:flex;align-items:center;gap:6px;background:var(--sf2);border:0.5px solid var(--br2);border-radius:var(--rads);padding:6px 9px;margin:8px 14px 4px;}
.fp-search input{border:none;background:transparent;font-size:12px;color:var(--tx);outline:none;font-family:inherit;width:100%;}
.fp-range{display:grid;grid-template-columns:1fr 1fr;gap:8px;padding:6px 14px 10px;}
.fp-range input{border:0.5px solid var(--br2);border-radius:var(--rads);padding:7px 9px;font-size:12px;color:var(--tx);background:var(--sf2);outline:none;font-family:inherit;width:100%;}
.fp-range input:focus{border-color:var(--p);}
.af-pill{display:inline-flex;align-items:center;gap:4px;padding:3px 8px 3px 9px;border-radius:20px;font-size:11px;font-weight:500;background:var(--pl);color:var(--pt);border:0.5px solid var(--pm);white-space:nowrap;flex-shrink:0;}
.af-pill-x{cursor:pointer;font-size:14px;line-height:1;color:var(--p);margin-left:2px;}
/* ─ DROPDOWN SEARCH ─ */
.ds-wrap{position:relative;}
.ds-input-row{display:flex;align-items:center;border:0.5px solid var(--br2);border-radius:var(--rads);background:var(--sf2);overflow:hidden;transition:border-color 0.15s;}
.ds-input-row:focus-within{border-color:var(--p);}
.ds-inp{flex:1;border:none;background:transparent;padding:9px 11px;font-size:13px;color:var(--tx);outline:none;font-family:inherit;}
.ds-arr{padding:0 10px;color:var(--tx3);cursor:pointer;user-select:none;font-size:12px;}
.ds-dropdown{position:absolute;z-index:200;top:calc(100% + 3px);left:0;right:0;background:var(--sf);border:0.5px solid var(--br2);border-radius:var(--rads);box-shadow:0 6px 20px rgba(0,0,0,0.14);max-height:190px;overflow-y:auto;display:none;}
.ds-dropdown.open{display:block;}
.ds-opt{padding:9px 12px;font-size:13px;color:var(--tx);cursor:pointer;border-bottom:0.5px solid var(--br);}
.ds-opt:last-child{border-bottom:none;}
.ds-opt:hover{background:var(--pl);color:var(--pt);}
.ds-tags{display:flex;flex-wrap:wrap;gap:5px;padding:5px 0 0;}
.ds-tag{display:inline-flex;align-items:center;gap:3px;padding:3px 8px;border-radius:20px;font-size:11px;font-weight:500;cursor:pointer;}
.ds-tag.size-s{background:#E6F1FB;color:#0C447C;}
.ds-tag.color-s{background:#FAEEDA;color:#633806;}
.ds-tag.custom-s{background:#EEEDFE;color:#3C3489;}
/* ─ MOVEMENT SCREEN ─ */
/* variant filter chips above movement chart */
.mv-var-chip{display:inline-flex;align-items:center;gap:3px;padding:5px 11px;border-radius:20px;font-size:11px;font-weight:500;border:0.5px solid var(--br2);color:var(--tx2);background:var(--sf2);cursor:pointer;white-space:nowrap;flex-shrink:0;transition:all 0.12s;}
.mv-var-chip:hover{background:var(--pl);border-color:var(--pm);color:var(--pt);}
.mv-var-chip.active{background:var(--pl);border-color:var(--pm);color:var(--pt);font-weight:600;}
#mv-var-chips{scrollbar-width:none;}
#mv-var-chips::-webkit-scrollbar{display:none;}
.mv-chart-wrap{background:var(--sf);border-radius:var(--rad);margin:10px 12px 0;border:0.5px solid var(--br);overflow:hidden;}
.mv-chart-hdr{padding:12px 14px 8px;display:flex;align-items:flex-start;justify-content:space-between;}
.mv-chart-lbl{font-size:11px;color:var(--tx3);margin-bottom:3px;}
.mv-chart-val{font-size:22px;font-weight:600;color:var(--tx);font-variant-numeric:tabular-nums;letter-spacing:-0.5px;}
.mv-chart-sub{font-size:11px;color:var(--tx3);margin-top:1px;}
.mv-chart-legend{display:flex;gap:12px;padding:0 14px 10px;font-size:10px;color:var(--tx3);}
.mv-leg-dot{width:7px;height:7px;border-radius:50%;display:inline-block;margin-right:3px;vertical-align:middle;}
.mv-svg-wrap{padding:0 14px 14px;}
.mv-svg-wrap svg{display:block;width:100%;overflow:visible;}
/* movement types */
.mv-type-grid{display:grid;grid-template-columns:1fr 1fr;gap:6px;padding:10px 16px 0;}
.mv-type-btn{padding:10px 8px;border-radius:10px;border:0.5px solid var(--br2);background:var(--sf2);cursor:pointer;font-size:11px;font-weight:500;color:var(--tx2);text-align:center;transition:all 0.15s;font-family:inherit;}
.mv-type-btn.mv-on-g{background:var(--gl);border-color:var(--g);color:var(--gt);}
.mv-type-btn.mv-on-r{background:var(--rl);border-color:var(--r);color:var(--rt);}
.mv-type-btn.mv-on-a{background:var(--al);border-color:var(--a);color:var(--at);}
.mv-type-btn.mv-on-p{background:var(--pl);border-color:var(--p);color:var(--pt);}
/* movement log rows */
.mv-row{display:flex;align-items:center;gap:10px;padding:10px 14px;border-bottom:0.5px solid var(--br);}
.mv-row:last-child{border-bottom:none;}
.mv-dot{width:28px;height:28px;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:13px;flex-shrink:0;}
.mv-dot.IN{background:var(--gl);color:var(--g);}
.mv-dot.OUT{background:var(--rl);color:var(--r);}
.mv-dot.ADJ{background:var(--al);color:var(--a);}
.mv-dot.PO{background:var(--bl);color:var(--b);}
.mv-dot.PROD{background:var(--pl);color:var(--p);}
.mv-dot.JOB{background:#FEF3C7;color:#92400E;}
.mv-info{flex:1;min-width:0;}
.mv-type-lbl{font-size:12px;font-weight:500;color:var(--tx);}
.mv-ref{font-size:11px;color:var(--tx2);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
.mv-qbadge{font-size:13px;font-weight:500;flex-shrink:0;}
.mv-qbadge.IN,.mv-qbadge.PO{color:var(--g);}
.mv-qbadge.OUT,.mv-qbadge.PROD,.mv-qbadge.JOB{color:var(--r);}
.mv-qbadge.ADJ{color:var(--a);}
.mv-date{font-size:10px;color:var(--tx3);flex-shrink:0;}
</style>

<script>
// ═══════════════════════════════════════════════════════
//  LABEL PRINTING MODULE — BoutiqBiz v5
// ═══════════════════════════════════════════════════════

var labelDesigns=[
  {id:'ld1',name:'Standard 50×30',size:'50x30',orientation:'portrait',barcodeType:'CODE128',
   fields:['brand','name','sku','mrp','offer','size','color','barcode'],customFields:[],color:'#4A3BB5'},
  {id:'ld2',name:'Reliance Trends',size:'80x50',orientation:'landscape',barcodeType:'CODE128',
   fields:['name','mrp','offer','sku','barcode','size','color'],
   customFields:[{label:'Dept',value:'Ethnic Wear'},{label:'Season',value:'AW26'}],color:'#185FA5'},
  {id:'ld3',name:'Pantaloons A6',size:'A6',orientation:'portrait',barcodeType:'CODE128',
   fields:['brand','name','sku','mrp','offer','size','color','barcode'],
   customFields:[{label:'Category',value:'Fusion'},{label:'Article No.',value:''}],color:'#993556'},
  {id:'ld4',name:'FBB Thermal',size:'40x25',orientation:'portrait',barcodeType:'EAN13',
   fields:['name','mrp','barcode'],customFields:[{label:'Vendor code',value:'FBB-VND'}],color:'#639922'}
];

var labelClients=[
  {id:'lc1',name:'Reliance Trends',defaultDesign:'ld2',notes:'Price tag mandatory. Barcode 300dpi.',fields:[{label:'Dept',value:'Ethnic Wear'},{label:'Season',value:'AW26'}]},
  {id:'lc2',name:'Pantaloons',defaultDesign:'ld3',notes:'Include article number. Min 10pt font.',fields:[{label:'Category',value:'Fusion'}]},
  {id:'lc3',name:'FBB',defaultDesign:'ld4',notes:'EAN-13 required. White background only.',fields:[{label:'Vendor code',value:'FBB-VND'}]}
];

var labelQueue=[];
var _editingDesignId=null;
var _editingClientId=null;
var _alSelectedDesignId=null;
var _alMatId=null;
var _alVarIdx=0;
var _labelSize='50x30';
var _labelOrientation='portrait';
var _labelBCType='CODE128';
var _ldeFields=['brand','name','sku','mrp','offer','size','color','barcode'];
var _ldeCustomFields=[];
var _clFields=[];

var LABEL_FIELD_OPTIONS=[
  {key:'brand',label:'Brand / Store name'},{key:'name',label:'Product name'},
  {key:'sku',label:'SKU'},{key:'barcode',label:'Barcode'},
  {key:'mrp',label:'MRP'},{key:'offer',label:'Offer / Sale price'},
  {key:'size',label:'Size'},{key:'color',label:'Colour'},
  {key:'desc',label:'Description'},{key:'vendor',label:'Vendor'},
  {key:'season',label:'Season'}
];

function goLabels(){
  renderLabelQueue();renderLabelDesigns();renderLabelClients();
  pushScreen('labels');
}

function setLTab(n){
  [0,1,2].forEach(function(i){
    var t=document.getElementById('ltab-'+i);if(t)t.classList.toggle('on',i===n);
    var p=document.getElementById('lpg-'+i);if(p)p.style.display=i===n?'block':'none';
  });
}

// Queue
function renderLabelQueue(){
  var el=document.getElementById('label-queue-list');
  var cnt=document.getElementById('lq-count');
  if(cnt)cnt.textContent=labelQueue.length+' item'+(labelQueue.length===1?'':'s')+' in queue';
  if(!el)return;
  if(!labelQueue.length){
    el.innerHTML='<div style="text-align:center;padding:40px 20px;"><svg style="color:var(--tx3);margin-bottom:12px;display:block;margin-left:auto;margin-right:auto;" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg><div style="font-size:14px;color:var(--tx2);margin-bottom:4px;">No labels queued</div><div style="font-size:12px;color:var(--tx3);">Tap + Add to start</div></div>';
    return;
  }
  el.innerHTML=labelQueue.map(function(item,idx){
    var m=materials.find(function(x){return x.id===item.matId;});
    var v=m?(m.variants[item.varIdx]||m.variants[0]):null;
    var d=labelDesigns.find(function(x){return x.id===item.designId;});
    var initials=m?m.name.split(' ').slice(0,2).map(function(w){return w[0];}).join('').toUpperCase():'?';
    return '<div class="lq-item">'+
      '<div class="lq-thumb">'+initials+'</div>'+
      '<div class="lq-info">'+
        '<div class="lq-name">'+(m?esc(m.name):'Unknown')+'</div>'+
        '<div class="lq-sub">'+(v?esc(v.name):'')+(d?' · '+esc(d.name):'')+'</div>'+
      '</div>'+
      '<div class="lq-qty-badge">×'+item.qty+'</div>'+
      '<button onclick="removeLabelQueueItem('+idx+')" style="background:none;border:none;cursor:pointer;color:var(--r);padding:4px;display:flex;align-items:center;"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6L6 18M6 6l12 12"/></svg></button>'+
    '</div>';
  }).join('');
}

function removeLabelQueueItem(idx){labelQueue.splice(idx,1);renderLabelQueue();}

function clearLabelQueue(){
  if(!labelQueue.length)return;
  if(!confirm('Clear all '+labelQueue.length+' items from the print queue?'))return;
  labelQueue=[];renderLabelQueue();showToast('Print queue cleared');
}

function printLabelQueue(){
  if(!labelQueue.length){showToast('Queue is empty');return;}
  buildPrintPreview();pushScreen('label-preview');
}

// Print preview
function buildPrintPreview(){
  var el=document.getElementById('print-area');if(!el)return;
  var copies=parseInt((document.getElementById('prev-copies')||{value:'1'}).value)||1;
  var html='<div style="padding:12px;display:flex;flex-wrap:wrap;gap:4px;">';
  labelQueue.forEach(function(item){
    var m=materials.find(function(x){return x.id===item.matId;});
    var v=m?(m.variants[item.varIdx]||m.variants[0]):null;
    var d=labelDesigns.find(function(x){return x.id===item.designId;})||labelDesigns[0];
    for(var c=0;c<(item.qty||1)*copies;c++){
      html+=buildSingleLabel(m,v,d,item.customOverrides||{});
    }
  });
  el.innerHTML=html+'</div>';
}

function buildSingleLabel(m,v,d,overrides){
  if(!m||!v||!d)return'';
  var fields=d.fields||[];
  var sizeMap={'50x30':{w:'50mm',h:'30mm'},'40x25':{w:'40mm',h:'25mm'},'80x50':{w:'80mm',h:'50mm'},'100x60':{w:'100mm',h:'60mm'},'A6':{w:'105mm',h:'148mm'}};
  var sz=sizeMap[d.size]||{w:'50mm',h:'30mm'};
  var wStyle=d.orientation==='landscape'?'width:'+sz.h+';min-height:'+sz.w+';':'width:'+sz.w+';min-height:'+sz.h+';';
  var sizeTags=(v.tags||[]).filter(function(t){return t.style==='size-s';}).map(function(t){return t.label;}).join('/');
  var colorTags=(v.tags||[]).filter(function(t){return t.style==='color-s';}).map(function(t){return t.label;}).join('/');
  var body='';
  if(fields.indexOf('brand')>-1)body+='<div style="text-align:center;font-size:10px;font-weight:700;color:#1A1740;letter-spacing:1px;margin-bottom:4px;">BOUTIQBIZ</div>';
  if(fields.indexOf('name')>-1)body+='<div style="font-size:11px;font-weight:600;color:#1A1740;line-height:1.2;margin-bottom:3px;">'+esc(m.name)+'</div>';
  if(fields.indexOf('sku')>-1)body+='<div style="font-size:8px;color:#888;font-family:monospace;margin-bottom:2px;">SKU: '+esc(v.sku||'')+'</div>';
  if(fields.indexOf('size')>-1&&sizeTags)body+='<div style="font-size:9px;color:#555;margin-bottom:1px;">Size: '+esc(sizeTags)+'</div>';
  if(fields.indexOf('color')>-1&&colorTags)body+='<div style="font-size:9px;color:#555;margin-bottom:1px;">Colour: '+esc(colorTags)+'</div>';
  if(fields.indexOf('mrp')>-1&&v.mrp)body+='<div style="font-size:9px;color:#999;text-decoration:line-through;margin-bottom:1px;">MRP: ₹'+esc(String(v.mrp))+'</div>';
  if(fields.indexOf('offer')>-1&&v.offer)body+='<div style="font-size:14px;font-weight:700;color:#1A1740;margin-bottom:3px;">₹'+esc(String(v.offer))+'</div>';
  (d.customFields||[]).forEach(function(cf){
    var val=overrides[cf.label]!==undefined?overrides[cf.label]:(cf.value||'');
    if(val)body+='<div style="font-size:9px;color:#555;margin-bottom:1px;">'+esc(cf.label)+': '+esc(val)+'</div>';
  });
  var bcHTML='';
  if(fields.indexOf('barcode')>-1&&d.barcodeType!=='none'){
    var bcVal=v.barcode||v.sku||'';
    var bcId='plbc-'+m.id+'-'+(v.sku||'x').replace(/[^a-z0-9]/gi,'');
    bcHTML='<div style="text-align:center;padding:4px 4px 2px;border-top:0.5px solid #eee;">'+
      '<canvas id="'+bcId+'" width="120" height="36"></canvas>'+
      '<div style="font-size:8px;color:#666;font-family:monospace;margin-top:1px;">'+esc(bcVal)+'</div></div>';
    var _bcVal=bcVal,_bcId=bcId;
    setTimeout(function(){renderBCCanvas(_bcVal,_bcId,null);},120);
  }
  return '<div class="print-label" style="'+wStyle+'"><div style="padding:6px 8px;flex:1;">'+body+'</div>'+bcHTML+'</div>';
}

// Add to queue sheet
function openAddLabelSheet(){
  _alMatId=null;_alVarIdx=0;
  _alSelectedDesignId=labelDesigns.length?labelDesigns[0].id:null;
  var sr=document.getElementById('al-search');if(sr)sr.value='';
  var ar=document.getElementById('al-results');if(ar)ar.innerHTML='<div style="padding:10px;font-size:13px;color:var(--tx3);">Type to search…</div>';
  var vs=document.getElementById('al-variant-section');if(vs)vs.style.display='none';
  var aq=document.getElementById('al-qty');if(aq)aq.value='1';
  renderALDesignPills();renderALCustomFields();
}

function searchAddLabel(q){
  var el=document.getElementById('al-results');
  if(!q.trim()){if(el)el.innerHTML='<div style="padding:10px;font-size:13px;color:var(--tx3);">Type to search…</div>';return;}
  var res=materials.filter(function(m){
    return m.name.toLowerCase().indexOf(q.toLowerCase())>-1||(m.sku||'').toLowerCase().indexOf(q.toLowerCase())>-1;
  }).slice(0,8);
  if(!res.length){if(el)el.innerHTML='<div style="padding:10px;font-size:13px;color:var(--tx3);">No results</div>';return;}
  if(!el)return;
  el.innerHTML=res.map(function(m){
    var sel=m.id===_alMatId;
    return '<div onclick="selectALMaterial('+m.id+')" style="padding:10px 12px;border-bottom:0.5px solid var(--br);cursor:pointer;display:flex;align-items:center;gap:10px;background:'+(sel?'var(--pl)':'var(--sf)')+';">'+
      '<div style="flex:1;"><div style="font-size:13px;font-weight:500;color:var(--tx);">'+esc(m.name)+'</div><div style="font-size:11px;color:var(--tx3);">'+esc(m.sku||'')+'</div></div>'+
      (sel?'<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="var(--p)" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>':'')+
    '</div>';
  }).join('');
}

function selectALMaterial(mid){
  _alMatId=mid;
  var m=materials.find(function(x){return x.id===mid;});
  if(!m)return;
  var vs=document.getElementById('al-variant-section');
  var vsel=document.getElementById('al-variant');
  if(vs)vs.style.display='block';
  if(vsel)vsel.innerHTML=(m.variants||[]).map(function(v,i){return '<option value="'+i+'">'+esc(v.name)+'</option>';}).join('');
  _alVarIdx=0;
  var sq=document.getElementById('al-search');
  searchAddLabel(sq?sq.value:'');
  renderALCustomFields();
}

function updateALVariant(){_alVarIdx=parseInt((document.getElementById('al-variant')||{value:'0'}).value)||0;}

function renderALDesignPills(){
  var el=document.getElementById('al-design-pills');if(!el)return;
  el.innerHTML=labelDesigns.map(function(d){
    var on=d.id===_alSelectedDesignId;
    return '<button onclick="selectALDesign(\'' + d.id + '\')" style="padding:6px 12px;border-radius:20px;border:0.5px solid '+(on?'var(--p)':'var(--br2)')+';background:'+(on?'var(--p)':'var(--sf2)')+';color:'+(on?'#fff':'var(--tx2)')+';font-size:12px;font-weight:500;cursor:pointer;font-family:inherit;">'+esc(d.name)+'</button>';
  }).join('');
}

function selectALDesign(id){_alSelectedDesignId=id;renderALDesignPills();renderALCustomFields();}

function renderALCustomFields(){
  var el=document.getElementById('al-custom-fields');
  var sec=document.getElementById('al-custom-fields-section');
  if(!el||!sec)return;
  var d=labelDesigns.find(function(x){return x.id===_alSelectedDesignId;});
  if(!d||!d.customFields||!d.customFields.length){sec.style.display='none';return;}
  sec.style.display='block';
  el.innerHTML=d.customFields.map(function(cf,ci){
    return '<div style="margin-bottom:8px;"><div class="lbl" style="margin-bottom:2px;">'+esc(cf.label)+'</div>'+
      '<input class="inp" type="text" id="al-cf-'+ci+'" value="'+esc(cf.value||'')+'" placeholder="'+esc(cf.label)+'"/></div>';
  }).join('');
}

function adjALQty(d){var inp=document.getElementById('al-qty');if(!inp)return;inp.value=Math.max(1,(parseInt(inp.value)||1)+d);}

function addToLabelQueue(){
  if(!_alMatId){showToast('Select a material first');return;}
  if(!_alSelectedDesignId){showToast('Select a label design');return;}
  var qty=parseInt((document.getElementById('al-qty')||{value:'1'}).value)||1;
  var d=labelDesigns.find(function(x){return x.id===_alSelectedDesignId;});
  var overrides={};
  if(d&&d.customFields){d.customFields.forEach(function(cf,ci){var inp=document.getElementById('al-cf-'+ci);if(inp)overrides[cf.label]=inp.value;});}
  labelQueue.push({matId:_alMatId,varIdx:_alVarIdx,designId:_alSelectedDesignId,qty:qty,customOverrides:overrides});
  closeSheet('sh-addlabel');renderLabelQueue();
  showToast(qty+' label'+(qty>1?'s':'')+' added to queue ✓');
}

// Design editor
function openLabelDesignEdit(id){
  _editingDesignId=id;
  var d=id?labelDesigns.find(function(x){return x.id===id;}):null;
  var ti=document.getElementById('lde-title');if(ti)ti.textContent=d?'Edit Design':'New Label Design';
  var ni=document.getElementById('lde-name');if(ni)ni.value=d?(d.name||''):'';
  _labelSize=d?(d.size||'50x30'):'50x30';
  _labelOrientation=d?(d.orientation||'portrait'):'portrait';
  _labelBCType=d?(d.barcodeType||'CODE128'):'CODE128';
  _ldeFields=d?(d.fields||[]).slice():['brand','name','sku','mrp','offer','size','color','barcode'];
  // sync pill states
  document.querySelectorAll('#lde-size-pills .val-chip').forEach(function(b){
    var sMap={'50×30mm':'50x30','40×25mm':'40x25','80×50mm':'80x50','100×60mm':'100x60','A6 (105×148mm)':'A6','Custom…':'custom'};
    b.classList.toggle('on',sMap[b.textContent.trim()]===_labelSize);
  });
  document.querySelectorAll('#lde-bc-pills .val-chip').forEach(function(b){
    var bMap={'Code 128':'CODE128','EAN-13':'EAN13','QR Code':'QR','None':'none'};
    b.classList.toggle('on',bMap[b.textContent.trim()]===_labelBCType);
  });
  var pi=document.getElementById('lde-portrait');if(pi)pi.classList.toggle('on',_labelOrientation==='portrait');
  var li2=document.getElementById('lde-landscape');if(li2)li2.classList.toggle('on',_labelOrientation==='landscape');
  var fEl=document.getElementById('lde-fields');
  if(fEl)fEl.innerHTML=LABEL_FIELD_OPTIONS.map(function(fo){
    var checked=_ldeFields.indexOf(fo.key)>-1;
    return '<label style="display:flex;align-items:center;gap:6px;padding:5px 8px;border-radius:6px;border:0.5px solid var(--br);cursor:pointer;font-size:12px;color:var(--tx);background:var(--sf);">'+
      '<input type="checkbox"'+(checked?' checked':'')+' onchange="toggleLDEField(\'' + fo.key + '\',this.checked)" style="accent-color:var(--p);"/>'+fo.label+'</label>';
  }).join('');
  renderLDECustomFields(d?(d.customFields||[]):[]);
  updateLDEPreview();
  openSheet('sh-label-design-edit');
}

function selectLabelSize(btn,size){
  _labelSize=size;
  document.querySelectorAll('#lde-size-pills .val-chip').forEach(function(b){b.classList.remove('on');});
  btn.classList.add('on');
  var cs=document.getElementById('lde-custom-size');
  if(cs)cs.style.display=size==='custom'?'flex':'none';
  updateLDEPreview();
}

function selectOrientation(btn,o){
  _labelOrientation=o;
  var pi=document.getElementById('lde-portrait');if(pi)pi.classList.toggle('on',o==='portrait');
  var la=document.getElementById('lde-landscape');if(la)la.classList.toggle('on',o==='landscape');
  updateLDEPreview();
}

function selectBCType(btn,t){
  _labelBCType=t;
  document.querySelectorAll('#lde-bc-pills .val-chip').forEach(function(b){b.classList.remove('on');});
  btn.classList.add('on');
  updateLDEPreview();
}

function toggleLDEField(key,checked){
  if(checked){if(_ldeFields.indexOf(key)===-1)_ldeFields.push(key);}
  else{_ldeFields=_ldeFields.filter(function(k){return k!==key;});}
  updateLDEPreview();
}

function renderLDECustomFields(fields){
  _ldeCustomFields=fields.slice();
  var el=document.getElementById('lde-custom-fields-list');if(!el)return;
  el.innerHTML=_ldeCustomFields.map(function(cf,i){
    return '<div style="display:flex;gap:6px;margin-bottom:6px;align-items:center;">'+
      '<input class="inp" type="text" placeholder="Field name" value="'+esc(cf.label||'')+'" oninput="_ldeCustomFields['+i+'].label=this.value;updateLDEPreview()" style="flex:1;padding:7px 9px;font-size:12px;"/>'+
      '<input class="inp" type="text" placeholder="Default value" value="'+esc(cf.value||'')+'" oninput="_ldeCustomFields['+i+'].value=this.value;updateLDEPreview()" style="flex:1;padding:7px 9px;font-size:12px;"/>'+
      '<button onclick="removeLDECustomField('+i+')" style="background:none;border:none;cursor:pointer;color:var(--r);font-size:18px;padding:0;line-height:1;">×</button>'+
    '</div>';
  }).join('');
}

function addLDECustomField(){_ldeCustomFields.push({label:'',value:''});renderLDECustomFields(_ldeCustomFields);}
function removeLDECustomField(i){_ldeCustomFields.splice(i,1);renderLDECustomFields(_ldeCustomFields);updateLDEPreview();}

function updateLDEPreview(){
  var el=document.getElementById('lde-preview');if(!el)return;
  var sampleM=materials[0]||{id:0,name:'Sample Product',sku:'SMPL-001',variants:[]};
  var sampleV=(sampleM.variants&&sampleM.variants[0])||{name:'S/Blue',sku:'SMPL-001-S',mrp:1500,offer:1200,barcode:'65895875',tags:[{label:'S',style:'size-s'},{label:'Blue',style:'color-s'}]};
  var d={id:'preview',name:'Preview',size:_labelSize,orientation:_labelOrientation,barcodeType:_labelBCType,fields:_ldeFields,customFields:_ldeCustomFields};
  el.innerHTML=buildSingleLabel(sampleM,sampleV,d,{});
}

function saveLabelDesign(){
  var name=((document.getElementById('lde-name')||{value:''}).value||'').trim();
  if(!name){showToast('Enter a design name');return;}
  var d={name:name,size:_labelSize,orientation:_labelOrientation,barcodeType:_labelBCType,
    fields:_ldeFields.slice(),customFields:_ldeCustomFields.slice(),color:COLORS[labelDesigns.length%COLORS.length]};
  if(_editingDesignId){
    var idx=labelDesigns.findIndex(function(x){return x.id===_editingDesignId;});
    if(idx>-1){d.id=_editingDesignId;labelDesigns[idx]=d;}else{d.id='ld'+Date.now();labelDesigns.push(d);}
  } else{d.id='ld'+Date.now();labelDesigns.push(d);}
  closeSheet('sh-label-design-edit');renderLabelDesigns();showToast('Label design saved ✓');
}

function renderLabelDesigns(){
  var el=document.getElementById('label-designs-list');if(!el)return;
  el.innerHTML=labelDesigns.map(function(d){
    return '<div class="ld-card"><div class="ld-hdr">'+
      '<div class="ld-ico"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M9 21V9"/></svg></div>'+
      '<div class="ld-info"><div class="ld-name">'+esc(d.name)+'</div>'+
      '<div class="ld-meta">'+esc(d.size)+' · '+esc(d.orientation)+' · '+esc(d.barcodeType)+
      (d.customFields&&d.customFields.length?' · '+d.customFields.length+' custom field'+(d.customFields.length>1?'s':''):'')+
      '</div></div>'+
      '<div class="ld-acts">'+
        '<button class="ld-act" onclick="openLabelDesignEdit(\'' + d.id + '\')">Edit</button>'+
        '<button class="ld-act" onclick="deleteLabelDesign(\'' + d.id + '\')" style="color:var(--r);">Delete</button>'+
      '</div></div></div>';
  }).join('');
}

function deleteLabelDesign(id){
  if(!confirm('Delete this label design?'))return;
  labelDesigns=labelDesigns.filter(function(d){return d.id!==id;});
  renderLabelDesigns();showToast('Design deleted');
}

// Client configs
function openClientLabelSheet(id){
  _editingClientId=id;
  var c=id?labelClients.find(function(x){return x.id===id;}):null;
  var ti=document.getElementById('cl-title');if(ti)ti.textContent=c?'Edit Client':'New Client Config';
  var ni=document.getElementById('cl-name');if(ni)ni.value=c?(c.name||''):'';
  var no=document.getElementById('cl-notes');if(no)no.value=c?(c.notes||''):'';
  var sel=document.getElementById('cl-design');
  if(sel)sel.innerHTML=labelDesigns.map(function(d){
    return '<option value="'+d.id+'"'+(c&&c.defaultDesign===d.id?' selected':'')+'>'+esc(d.name)+'</option>';
  }).join('');
  renderCLFields(c?(c.fields||[]):[]);
  openSheet('sh-client-label');
}

function renderCLFields(fields){
  _clFields=fields.slice();
  var el=document.getElementById('cl-custom-fields');if(!el)return;
  el.innerHTML=_clFields.map(function(cf,i){
    return '<div style="display:flex;gap:6px;margin-bottom:6px;align-items:center;">'+
      '<input class="inp" type="text" placeholder="Field name" value="'+esc(cf.label||'')+'" oninput="_clFields['+i+'].label=this.value" style="flex:1;padding:7px 9px;font-size:12px;"/>'+
      '<input class="inp" type="text" placeholder="Value" value="'+esc(cf.value||'')+'" oninput="_clFields['+i+'].value=this.value" style="flex:1;padding:7px 9px;font-size:12px;"/>'+
      '<button onclick="removeCLField('+i+')" style="background:none;border:none;cursor:pointer;color:var(--r);font-size:18px;padding:0;line-height:1;">×</button>'+
    '</div>';
  }).join('');
}
function addCLField(){_clFields.push({label:'',value:''});renderCLFields(_clFields);}
function removeCLField(i){_clFields.splice(i,1);renderCLFields(_clFields);}

function saveClientConfig(){
  var name=((document.getElementById('cl-name')||{value:''}).value||'').trim();
  if(!name){showToast('Enter a client name');return;}
  var c={name:name,defaultDesign:(document.getElementById('cl-design')||{value:''}).value,
    notes:(document.getElementById('cl-notes')||{value:''}).value,fields:_clFields.slice()};
  if(_editingClientId){
    var idx=labelClients.findIndex(function(x){return x.id===_editingClientId;});
    if(idx>-1){c.id=_editingClientId;labelClients[idx]=c;}else{c.id='lc'+Date.now();labelClients.push(c);}
  }else{c.id='lc'+Date.now();labelClients.push(c);}
  closeSheet('sh-client-label');renderLabelClients();showToast('Client config saved ✓');
}

function renderLabelClients(){
  var el=document.getElementById('label-clients-list');if(!el)return;
  el.innerHTML=labelClients.map(function(c){
    var d=labelDesigns.find(function(x){return x.id===c.defaultDesign;});
    return '<div class="ld-card"><div class="ld-hdr">'+
      '<div class="ld-ico" style="background:var(--al);color:var(--at);"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20 7H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2zM16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg></div>'+
      '<div class="ld-info"><div class="ld-name">'+esc(c.name)+'</div>'+
      '<div class="ld-meta">'+(d?esc(d.name):'No design')+(c.fields&&c.fields.length?' · '+c.fields.length+' field'+(c.fields.length>1?'s':''):'')+
      (c.notes?' · has notes':'')+
      '</div></div>'+
      '<div class="ld-acts">'+
        '<button class="ld-act" onclick="openClientLabelSheet(\'' + c.id + '\')">Edit</button>'+
        '<button class="ld-act" onclick="useClientDesign(\'' + c.id + '\')" style="color:var(--p);">Use</button>'+
      '</div></div></div>';
  }).join('');
}

function useClientDesign(cid){
  var c=labelClients.find(function(x){return x.id===cid;});if(!c)return;
  _alSelectedDesignId=c.defaultDesign;
  setLTab(0);openAddLabelSheet();openSheet('sh-addlabel');
  showToast('Using '+c.name+' label config');
}

// ═══════════════════════════════
//  COLUMN VISIBILITY
// ═══════════════════════════════
var colDefs=[
  {key:'sku',label:'SKU'},
  {key:'vendor',label:'Vendor'},
  {key:'varcount',label:'Variant count'},
  {key:'qty',label:'Stock quantity'},
  {key:'type_badge',label:'Type badge (Finished/Raw)'},
  {key:'collection_btn',label:'Collection button'},
  {key:'value',label:'Stock value'},
  {key:'avgcost',label:'Average cost price'},
];
function toggleCol(cb){
  var key=cb.getAttribute('data-col');
  if(key)visibleCols[key]=cb.checked;
}
function openColToggle(){
  var el=document.getElementById('col-toggle-list');
  if(!el)return;
  el.innerHTML=colDefs.map(function(c){
    return '<label style="display:flex;align-items:center;gap:12px;padding:11px 16px;border-bottom:0.5px solid var(--br);cursor:pointer;">'+
      '<input type="checkbox" data-col="'+c.key+'" '+(visibleCols[c.key]?'checked':'')+' onchange="toggleCol(this)" style="width:16px;height:16px;accent-color:var(--p);cursor:pointer;"/>'+
      '<span style="font-size:13px;color:var(--tx);">'+c.label+'</span>'+
    '</label>';
  }).join('');
  openSheet('sh-columns');
}



// ═══════════════════ V6 NEW FEATURES ═══════════════════

// ─ VIEW MODE ─
var currentView = 'list';
function setView(v) {
  currentView = v;
  var sb = document.querySelector('#s-list .scroll-body');
  if(sb) { sb.className = 'scroll-body view-' + v; }
  ['list','gallery','large'].forEach(function(mode) {
    var btn = document.getElementById('vtb-' + mode);
    if(btn) btn.classList.toggle('on', mode === v);
  });
  renderList();
}

// ─ COLLAPSIBLE NAV SECTIONS ─
function toggleNavSec(id) {
  var body = document.getElementById('navsec-' + id);
  var hdr = document.getElementById('navsec-' + id + '-hdr');
  if(!body || !hdr) return;
  var collapsed = body.classList.contains('collapsed');
  if(collapsed) {
    body.classList.remove('collapsed');
    body.style.maxHeight = '300px';
    hdr.classList.remove('collapsed');
  } else {
    body.classList.add('collapsed');
    body.style.maxHeight = '0';
    hdr.classList.add('collapsed');
  }
}

// ─ ENHANCED FILTER ─
// Extend activeF with new fields
activeF.keyword = '';
activeF.stockStatus = [];
activeF.priceMin = null;
activeF.priceMax = null;
activeF.hasImages = null;
activeF.colIds = [];

// Populate dynamic vendor and collection filter lists
function fpVendorChange(cb){toggleFPCheck("vendor",cb.getAttribute("data-v"),cb.checked);}
function fpColChange(cb){toggleFPCheck("colId",cb.getAttribute("data-cid"),cb.checked);}
function populateFilterLists() {
  var vendors = [];
  materials.forEach(function(m) {
    (m.vendors||[]).forEach(function(v) { if(!vendors.includes(v.name)) vendors.push(v.name); });
  });
  if(!vendors.includes("Unassigned")) vendors.push("Unassigned");
  var vEl = document.getElementById("fpb-vendor-list");
  if(vEl) vEl.innerHTML = vendors.map(function(v) {
    var vesc = v.replace(/"/g,"&quot;");
    return "<label class=\"fp-check\"><input type=\"checkbox\" onchange=\"fpVendorChange(this)\" data-v=\""+vesc+"\"/> "+v+"</label>";
  }).join("");
  var cEl = document.getElementById("fpb-col-list");
  if(cEl) cEl.innerHTML = collections.length ?
    collections.map(function(col) {
      return "<label class=\"fp-check\"><input type=\"checkbox\" onchange=\"fpColChange(this)\" data-cid=\""+col.id+"\"/> <span style=\"display:inline-block;width:8px;height:8px;border-radius:50%;background:"+col.color+";margin-right:4px;vertical-align:middle;\"></span>"+col.name+"</label>";
    }).join("") :
    "<div style=\"padding:9px 14px;font-size:12px;color:var(--tx3);\">No collections yet</div>";
}

// Override applyF to support new fields
var _origApplyF = applyF;
applyF = function(data) {
  var d = _origApplyF(data);
  // keyword (broader than searchQ)
  if(activeF.keyword) {
    var kw = activeF.keyword.toLowerCase();
    d = d.filter(function(m) {
      return m.name.toLowerCase().includes(kw) ||
        (m.sku||'').toLowerCase().includes(kw) ||
        (m.tags||[]).some(function(t){return t.toLowerCase().includes(kw);}) ||
        m.variants.some(function(v){return v.name.toLowerCase().includes(kw)||(v.sku||'').toLowerCase().includes(kw);});
    });
  }
  // stock status
  if(activeF.stockStatus && activeF.stockStatus.length) {
    d = d.filter(function(m) {
      var tq = m.variants.reduce(function(s,v){return s+(parseInt(v.qty)||0);},0);
      var hasLow = m.variants.some(function(v){return (parseInt(v.qty)||0)<=(v.minqty||0)&&(v.minqty||0)>0;});
      return activeF.stockStatus.some(function(s) {
        if(s==='in-stock') return tq > 0 && !hasLow;
        if(s==='low-stock') return hasLow;
        if(s==='out-of-stock') return tq === 0;
        return false;
      });
    });
  }
  // price range
  if(activeF.priceMin!=null||activeF.priceMax!=null) {
    d = d.filter(function(m) {
      var mrps = m.variants.map(function(v){return parseFloat(v.mrp)||0;});
      var maxMrp = Math.max.apply(null,mrps);
      if(activeF.priceMin!=null && maxMrp < activeF.priceMin) return false;
      if(activeF.priceMax!=null && maxMrp > activeF.priceMax) return false;
      return true;
    });
  }
  // has images
  if(activeF.hasImages !== null) {
    d = d.filter(function(m) {
      var has = m.imgs && m.imgs.length > 0;
      return activeF.hasImages ? has : !has;
    });
  }
  // collection filter
  if(activeF.colIds && activeF.colIds.length) {
    d = d.filter(function(m) {
      return activeF.colIds.some(function(cid) {
        var col = collections.find(function(c){return c.id===cid;});
        if(!col) return false;
        return colMaterials(col).some(function(cm){return cm.id===m.id;});
      });
    });
  }
  // extended sort options
  if(activeF.sort === 'name-z') d.sort(function(a,b){return b.name.localeCompare(a.name);});
  if(activeF.sort === 'price-hi') {
    d.sort(function(a,b) {
      var am = Math.max.apply(null,a.variants.map(function(v){return parseFloat(v.mrp)||0;}));
      var bm = Math.max.apply(null,b.variants.map(function(v){return parseFloat(v.mrp)||0;}));
      return bm - am;
    });
  }
  return d;
};

function toggleFPCheck(field, val, checked) {
  if(field==='stockStatus') {
    if(checked){if(!activeF.stockStatus.includes(val))activeF.stockStatus.push(val);}
    else{activeF.stockStatus=activeF.stockStatus.filter(function(v){return v!==val;});}
    updateFPBadge('stock');
  } else if(field==='colId') {
    if(checked){if(!activeF.colIds.includes(val))activeF.colIds.push(val);}
    else{activeF.colIds=activeF.colIds.filter(function(v){return v!==val;});}
    updateFPBadge('col');
  } else if(field==='type') {
    if(checked){if(!activeF.types.includes(val))activeF.types.push(val);}
    else{activeF.types=activeF.types.filter(function(v){return v!==val;});}
    updateFPBadge('type');
  } else if(field==='vendor') {
    if(checked){if(!activeF.vendors.includes(val))activeF.vendors.push(val);}
    else{activeF.vendors=activeF.vendors.filter(function(v){return v!==val;});}
    updateFPBadge('vendor');
  }
  renderActiveFilters();
}

function renderActiveFilters() {
  var el = document.getElementById('af-bar');
  if(!el) return;
  var pills = [];
  if(activeF.types.length) activeF.types.forEach(function(t){ pills.push({label:t,clear:function(){activeF.types=activeF.types.filter(function(x){return x!==t;});renderList();renderActiveFilters();}}); });
  if(activeF.stockStatus && activeF.stockStatus.length) activeF.stockStatus.forEach(function(s){ pills.push({label:s.replace('-',' '),clear:function(){activeF.stockStatus=activeF.stockStatus.filter(function(x){return x!==s;});renderList();renderActiveFilters();}}); });
  if(activeF.vendors.length) activeF.vendors.forEach(function(v){ pills.push({label:'Vendor: '+v,clear:function(){activeF.vendors=activeF.vendors.filter(function(x){return x!==v;});renderList();renderActiveFilters();}}); });
  if(activeF.qmin||activeF.qmax) pills.push({label:'Qty: '+(activeF.qmin||0)+'–'+(activeF.qmax||'∞'),clear:function(){activeF.qmin=null;activeF.qmax=null;renderList();renderActiveFilters();}});
  if(activeF.priceMin||activeF.priceMax) pills.push({label:'₹'+(activeF.priceMin||0)+'–'+(activeF.priceMax||'∞'),clear:function(){activeF.priceMin=null;activeF.priceMax=null;renderList();renderActiveFilters();}});
  if(activeF.hasImages!==null) pills.push({label:activeF.hasImages?'Has images':'No images',clear:function(){activeF.hasImages=null;renderList();renderActiveFilters();}});
  el.innerHTML = pills.map(function(p,i){
    return '<span class="af-pill">'+p.label+'<span class="af-pill-x" onclick="('+p.clear.toString()+')()">×</span></span>';
  }).join('');
  el.style.display = pills.length ? 'flex' : 'none';
}

// ─ ENHANCED MOVEMENT TYPE SETTER ─
function setMvType(t, btn) {
  document.getElementById('mv-type').value = t;
  var styleMap = {IN:'mv-on-g', OUT:'mv-on-r', PO:'mv-on-p', PROD:'mv-on-r', JOB:'mv-on-a', ADJ:'mv-on-a'};
  document.querySelectorAll('#mv-type-row .mv-type-btn').forEach(function(b) {
    b.className = 'mv-type-btn' + (b.getAttribute('data-mv')===t ? ' ' + (styleMap[t]||'mv-on-p') : '');
  });
}

// ─ MOVEMENT DETAIL SCREEN (for material detail tab) ─
var _mvChartVar = null; // null = all variants

function setMvChartVar(matId, varIdx) {
  _mvChartVar = varIdx;
  var mat = materials.find(function(x){return x.id===matId;});
  if(mat) buildMDMovementInto(mat);
}

function buildMDMovement(m) {
  _mvChartVar = null;
  buildMDMovementInto(m);
}

function buildMDMovementInto(m) {
  var allMvs = movements.filter(function(x){return x.matId===m.id;});
  // Filter by selected variant
  var mvs = (_mvChartVar===null) ? allMvs.slice() : allMvs.filter(function(x){return x.varIdx===_mvChartVar;});
  mvs.sort(function(a,b){return new Date(b.date)-new Date(a.date);});

  // Build inventory chart data (last 8 weeks)
  var weeks = [];
  var now = new Date();
  for(var wi=7;wi>=0;wi--) {
    var d = new Date(now); d.setDate(d.getDate()-wi*7);
    weeks.push({label: (d.getMonth()+1)+'/'+(d.getDate()), inQty:0, outQty:0});
  }
  mvs.forEach(function(mv) {
    var mvDate = new Date(mv.date);
    weeks.forEach(function(w,wi) {
      var wStart = new Date(now); wStart.setDate(wStart.getDate()-(7-wi)*7);
      var wEnd = new Date(now); wEnd.setDate(wEnd.getDate()-(6-wi)*7);
      if(mvDate>=wStart && mvDate<wEnd) {
        if(['IN','PO'].includes(mv.type)) w.inQty += (mv.qty||0);
        else if(['OUT','PROD','JOB'].includes(mv.type)) w.outQty += (mv.qty||0);
      }
    });
  });
  var maxVal = Math.max(1, Math.max.apply(null, weeks.map(function(w){return Math.max(w.inQty,w.outQty);})));

  // Total qty for selected variant(s)
  var totalQty;
  if(_mvChartVar===null) {
    totalQty = m.variants.reduce(function(s,v){return s+(parseInt(v.qty)||0);},0);
  } else {
    totalQty = parseInt((m.variants[_mvChartVar]||{}).qty)||0;
  }

  var html = '';

  // ── Variant filter chips ──
  html += '<div style="display:flex;gap:6px;padding:10px 12px 6px;overflow-x:auto;flex-shrink:0;" id="mv-var-chips">';
  html += '<div class="mv-var-chip'+(_mvChartVar===null?' active':'')+'" onclick="setMvChartVar('+m.id+',null)">All variants</div>';
  m.variants.forEach(function(v,vi){
    var dot = v.color ? '<span style="display:inline-block;width:8px;height:8px;border-radius:50%;background:'+v.color+';margin-right:4px;vertical-align:middle;"></span>' : '';
    html += '<div class="mv-var-chip'+(_mvChartVar===vi?' active':'')+'" onclick="setMvChartVar('+m.id+','+vi+')">'+dot+esc(v.name||('Variant '+(vi+1)))+'</div>';
  });
  html += '</div>';

  // Chart card
  html += '<div class="mv-chart-wrap">';
  html += '<div class="mv-chart-hdr">';
  html += '<div><div class="mv-chart-lbl">Current stock</div><div class="mv-chart-val">'+totalQty+' units</div><div class="mv-chart-sub">'+mvs.length+' movement'+(mvs.length!==1?'s':'')+' total</div></div>';
  html += '<button onclick="openAddMovement('+m.id+')" style="padding:7px 12px;border-radius:var(--rads);background:var(--p);color:#fff;border:none;font-size:12px;font-weight:500;cursor:pointer;font-family:inherit;">+ Add</button>';
  html += '</div>';
  
  // SVG bar chart
  var chartW = 300, chartH = 80, barW = 20, gap = (chartW - weeks.length*barW*2)/(weeks.length+1);
  html += '<div class="mv-svg-wrap"><svg viewBox="0 0 '+chartW+' '+(chartH+20)+'" preserveAspectRatio="none">';
  weeks.forEach(function(w,i) {
    var x = gap + i*(barW*2+gap);
    var inH = Math.round((w.inQty/maxVal)*chartH);
    var outH = Math.round((w.outQty/maxVal)*chartH);
    if(w.inQty>0) html += '<rect x="'+x+'" y="'+(chartH-inH)+'" width="'+barW+'" height="'+inH+'" rx="3" fill="var(--g)" opacity="0.85"/>';
    if(w.outQty>0) html += '<rect x="'+(x+barW+1)+'" y="'+(chartH-outH)+'" width="'+barW+'" height="'+outH+'" rx="3" fill="var(--r)" opacity="0.75"/>';
    html += '<text x="'+(x+barW)+'" y="'+(chartH+14)+'" text-anchor="middle" font-size="8" fill="var(--tx3)">'+w.label+'</text>';
  });
  html += '</svg></div>';
  
  // Legend
  html += '<div class="mv-chart-legend">';
  html += '<span><span class="mv-leg-dot" style="background:var(--g);"></span>Stock IN</span>';
  html += '<span><span class="mv-leg-dot" style="background:var(--r);"></span>Stock OUT</span>';
  html += '</div>';
  html += '</div>';
  
  // Movement log
  html += '<div class="sec" style="margin-top:10px;">';
  html += '<div class="sec-hdr"><span class="sec-title">All movements</span></div>';
  
  var typeLabels = {IN:'Stock IN', OUT:'Stock OUT', PO:'Purchase Order', PROD:'Used in Production', JOB:'Jobber', ADJ:'Adjustment'};
  var typeEmoji = {IN:'↑', OUT:'↓', PO:'📦', PROD:'🏭', JOB:'🔀', ADJ:'⇆'};
  
  if(!mvs.length) {
    html += '<div style="padding:20px;text-align:center;font-size:13px;color:var(--tx3);">No movements recorded yet.<br><button onclick="openAddMovement('+m.id+')" style="margin-top:10px;padding:8px 16px;border-radius:var(--rads);background:var(--p);color:#fff;border:none;font-size:13px;cursor:pointer;font-family:inherit;">+ Record first movement</button></div>';
  } else {
    mvs.forEach(function(mv) {
      var v = m.variants[mv.varIdx]||m.variants[0]||{};
      var sign = ['IN','PO'].includes(mv.type) ? '+' : ['ADJ'].includes(mv.type) ? '±' : '-';
      var color = ['IN','PO'].includes(mv.type) ? 'IN' : ['ADJ'].includes(mv.type) ? 'ADJ' : 'OUT';
      html += '<div class="mv-row">';
      html += '<div class="mv-dot '+mv.type+'">'+(typeEmoji[mv.type]||'•')+'</div>';
      html += '<div class="mv-info">';
      html += '<div class="mv-type-lbl">'+(typeLabels[mv.type]||mv.type);
      if(v.name) html += ' <span style="font-size:10px;color:var(--tx3);font-weight:400;">— '+v.name+'</span>';
      html += '</div>';
      if(mv.ref||mv.notes) html += '<div class="mv-ref">'+(mv.ref?mv.ref:'')+( mv.ref&&mv.notes?' · ':'')+( mv.notes?mv.notes:'')+'</div>';
      html += '</div>';
      html += '<div class="mv-qbadge '+color+'">'+sign+(mv.qty||0)+'</div>';
      html += '<div class="mv-date">'+(mv.date||'').slice(0,10)+'</div>';
      html += '</div>';
    });
  }
  html += '</div>';
  html += '<div style="height:20px;"></div>';
  var pg = document.getElementById('mdpg-2');
  if(pg) pg.innerHTML = html;
  return html;
}

// ─ DROPDOWN SEARCH COMPONENT ─
// Creates a searchable dropdown for option values (color, size)
function createDropdownSearch(containerId, options, selected, onSelect, placeholder) {
  var wrap = document.getElementById(containerId);
  if(!wrap) return;
  wrap.className = 'ds-wrap';
  var open = false;
  var q = '';
  function render() {
    var filtered = options.filter(function(o){return !q||o.toLowerCase().includes(q.toLowerCase());});
    var ddHtml = filtered.length ? filtered.map(function(o){
      var sel = selected.includes(o);
      return '<div class="ds-opt'+(sel?' focused':'"onmousedown="event.preventDefault()"')+'" onmousedown="event.preventDefault()" onclick="dsSelect(this,\'' + containerId + '\')" data-val="'+o+'">'+(sel?'✓ ':'')+o+'</div>';
    }).join('') : '<div style="padding:10px 12px;font-size:12px;color:var(--tx3);">No options found</div>';
    var tagsHtml = selected.map(function(s){
      return '<span class="ds-tag color-s" onmousedown="event.preventDefault()" onclick="dsRemove(this,\'' + containerId + '\')" data-val="'+s+'">'+s+' ×</span>';
    }).join('');
    wrap.innerHTML = '<div class="ds-input-row"><input class="ds-inp" type="text" placeholder="'+(placeholder||'Search...')+'" autocomplete="off" oninput="dsFilter(this,\'' + containerId + '\',this.value)" onfocus="dsOpenDrop(\'' + containerId + '\')" onblur="setTimeout(function(){dsCloseDrop(\'' + containerId + '\')},150)"/><span class="ds-arr" onmousedown="event.preventDefault()" onclick="dsToggle(\'' + containerId + '\')">▾</span></div><div class="ds-dropdown'+(open?' open':'')+'" id="dsd-'+containerId+'">'+ddHtml+'</div><div class="ds-tags">'+tagsHtml+'</div>';
    var inp = wrap.querySelector('.ds-inp');
    if(inp) inp.value = q;
    wrap.__selected = selected;
    wrap.__options = options;
    wrap.__onSelect = onSelect;
    wrap.__placeholder = placeholder;
  }
  wrap.__render = render;
  render();
}
function dsFilter(inp, cid, val) {
  var wrap = document.getElementById(cid); if(!wrap||!wrap.__render) return;
  var old = inp.value; wrap.__q = val;
  dsOpenDrop(cid); wrap.__render();
  var ni = wrap.querySelector('.ds-inp'); if(ni){ni.value=val;ni.focus();}
}
function dsOpenDrop(cid) {
  var wrap = document.getElementById(cid); if(!wrap) return;
  var dd = document.getElementById('dsd-'+cid); if(dd) dd.classList.add('open');
}
function dsCloseDrop(cid) {
  var dd = document.getElementById('dsd-'+cid); if(dd) dd.classList.remove('open');
}
function dsToggle(cid) {
  var dd = document.getElementById('dsd-'+cid); if(dd) dd.classList.toggle('open');
}
function dsSelect(el, cid) {
  var wrap = document.getElementById(cid); if(!wrap) return;
  var val = el.getAttribute('data-val');
  if(!wrap.__selected) wrap.__selected = [];
  if(!wrap.__selected.includes(val)) { wrap.__selected.push(val); if(wrap.__onSelect) wrap.__onSelect(wrap.__selected.slice()); }
  var inp = wrap.querySelector('.ds-inp'); if(inp) {inp.value=''; wrap.__q='';}
  if(wrap.__render) wrap.__render();
}
function dsRemove(el, cid) {
  var wrap = document.getElementById(cid); if(!wrap) return;
  var val = el.getAttribute('data-val');
  wrap.__selected = (wrap.__selected||[]).filter(function(x){return x!==val;});
  if(wrap.__onSelect) wrap.__onSelect(wrap.__selected.slice());
  if(wrap.__render) wrap.__render();
}

// ─ INIT HOOK ─
var _origInit = typeof init==='function'?init:function(){};
// Patch renderList to use gallery/large view
var _origRenderList = renderList;
renderList = function() {
  _origRenderList();
  // After renderList runs, wrap the scroll-body with view class
  var sb = document.querySelector('#s-list .scroll-body');
  if(sb && currentView !== 'list') {
    if(!sb.classList.contains('view-'+currentView)) {
      sb.className = 'scroll-body view-'+currentView;
    }
  }
};

// Hook into filter panel open to populate dynamic lists
var _origToggleFilterPanel = typeof toggleFilterPanel==='function'?toggleFilterPanel:function(){};
toggleFilterPanel = function() {
  _origToggleFilterPanel();
  populateFilterLists();
};

// ─ PHP OUTPUT HELPERS (for PHP integration) ─
// In PHP mode, these functions would be replaced by server-rendered data
function phpExportData() {
  var data = {
    materials: materials,
    movements: movements,
    collections: collections,
    labelDesigns: labelDesigns,
    labelClients: labelClients,
    labelQueue: labelQueue
  };
  return JSON.stringify(data, null, 2);
}

// ═══════════════════ END V6 ═══════════════════

</script>

<!-- ════ SHEET: NEW / EDIT CUSTOM TAB ════ -->
<div class="sh-ov" id="sh-newtab" onclick="if(event.target===this)closeSheet('sh-newtab')">
  <div style="flex:1;"></div>
  <div class="sh">
    <div class="sh-hdl"></div>
    <div class="sh-top">
      <span class="sh-main-title" id="sh-newtab-title">New tab</span>
      <span class="sh-close" onclick="closeSheet('sh-newtab')"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6L6 18M6 6l12 12"/></svg></span>
    </div>
    <div style="padding:4px 14px 16px;">
      <div class="fi-row"><label class="fi-label">Tab name</label><input class="fi-inp" id="newtab-name" placeholder="e.g. Low Stock, Boho, Silk…"/></div>
      <div class="fi-row">
        <label class="fi-label">Tab colour</label>
        <div style="display:flex;gap:8px;flex-wrap:wrap;margin-top:4px;">
          <div class="ctab-color-sw ctab-sw-sel" data-c="#4A3BB5" style="background:#4A3BB5;" onclick="pickCtabColor(this)"></div>
          <div class="ctab-color-sw" data-c="#E24B4A" style="background:#E24B4A;" onclick="pickCtabColor(this)"></div>
          <div class="ctab-color-sw" data-c="#1D9E75" style="background:#1D9E75;" onclick="pickCtabColor(this)"></div>
          <div class="ctab-color-sw" data-c="#D97706" style="background:#D97706;" onclick="pickCtabColor(this)"></div>
          <div class="ctab-color-sw" data-c="#7C3AED" style="background:#7C3AED;" onclick="pickCtabColor(this)"></div>
          <div class="ctab-color-sw" data-c="#0369A1" style="background:#0369A1;" onclick="pickCtabColor(this)"></div>
          <div class="ctab-color-sw" data-c="#9F1239" style="background:#9F1239;" onclick="pickCtabColor(this)"></div>
        </div>
      </div>
      <div class="fi-row">
        <label class="fi-label">Stock status</label>
        <div style="display:flex;gap:6px;flex-wrap:wrap;margin-top:6px;">
          <div class="fp-chip newtab-ss" data-ss="in_stock" onclick="toggleNtSS(this)">In stock</div>
          <div class="fp-chip newtab-ss" data-ss="low" onclick="toggleNtSS(this)">Low stock</div>
          <div class="fp-chip newtab-ss" data-ss="out" onclick="toggleNtSS(this)">Out of stock</div>
        </div>
      </div>
      <div class="fi-row"><label class="fi-label">Vendor (optional)</label><input class="fi-inp" id="newtab-vendor" placeholder="e.g. Fab India"/></div>
      <div class="fi-row"><label class="fi-label">Tag (optional)</label><input class="fi-inp" id="newtab-tag" placeholder="e.g. Boho, Silk, Chatri…"/></div>
      <div class="fi-row"><label class="fi-label">Keyword (optional)</label><input class="fi-inp" id="newtab-search" placeholder="e.g. Aakaar"/></div>
    </div>
    <button class="sh-done" onclick="saveCustomTab()">Save tab</button>
    <button id="newtab-del-btn" onclick="deleteCustomTab()" style="display:block;width:calc(100% - 28px);margin:8px 14px 0;padding:11px;border-radius:var(--rads);background:transparent;color:var(--r);border:0.5px solid var(--rm,#f5a5a5);font-size:13px;font-weight:500;cursor:pointer;font-family:inherit;display:none;">Delete tab</button>
    <div style="height:8px;"></div>
  </div>
</div>
<style>
.ctab-color-sw{width:26px;height:26px;border-radius:50%;cursor:pointer;border:3px solid transparent;transition:border-color 0.12s;}
.ctab-sw-sel{border-color:var(--p)!important;}
.fi-row{margin-bottom:12px;}
.fi-label{display:block;font-size:11px;font-weight:600;color:var(--tx2);text-transform:uppercase;letter-spacing:0.4px;margin-bottom:5px;}
</style>
<script>
// Wire openSheet('sh-newtab') calls to openNewTabSheet
document.querySelectorAll('[onclick="openSheet(\'sh-newtab\')"]').forEach(function(el){
  el.setAttribute('onclick','openNewTabSheet()');
});
// Show delete button when editing
var _ntOrig=saveCustomTab;
</script>

<!-- ════ SHEET: COLUMN SELECTOR ════ -->
<div class="sh-ov" id="sh-columns" onclick="if(event.target===this)closeSheet('sh-columns')">
  <div style="flex:1;"></div>
  <div class="sh">
    <div class="sh-hdl"></div>
    <div class="sh-top">
      <span class="sh-main-title">Columns</span>
      <span class="sh-close" onclick="closeSheet('sh-columns')"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6L6 18M6 6l12 12"/></svg></span>
    </div>
    <div style="padding:8px 0 4px;font-size:12px;color:var(--tx2);padding-left:16px;">Choose what to show on each material card</div>
    <div id="col-toggle-list" style="padding:4px 0 8px;"></div>
    <button class="sh-done" onclick="closeSheet('sh-columns');renderList();">Apply</button>
    <div style="height:8px;"></div>
  </div>
</div>
</body>
</html>
