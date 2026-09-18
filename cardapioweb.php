<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Cardápio & Vitrine Digital</title>

  <!-- Fallbacks dos arquivos locais existentes -->
  <script src="loja.js"></script>
  <script src="categorias.js"></script>
  <script src="produtos.js"></script>

  <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@400;700&family=Montserrat:wght@600;800&family=Poppins:wght@400;700;900&display=swap" rel="stylesheet">

  <style>
    :root {
      --primary-color: #FFD400;
      --secondary-color: #7B2CBF;
      --bg-color: #f8fafc;
      --card-bg: #ffffff;
      --text-color: #1f2937;
      --text-muted: #6b7280;
      --border-color: #e5e7eb;
      --whatsapp-green: #25D366;
      --success-color: #16a34a;

      /* VARIÁVEIS EXCLUSIVAS DO CARDÁPIO IMPRESSO */
      --print-cor-primaria: #f4b800;
      --print-cor-secundaria: #222222;
      --print-cor-fundo: #ffffff;
    }

    * { box-sizing: border-box; margin: 0; padding: 0; -webkit-tap-highlight-color: transparent; }

    body {
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
      background-color: var(--bg-color);
      color: var(--text-color);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      padding-bottom: 120px;
    }

    .main-wrapper { width: 100%; max-width: 600px; padding: 16px; }

    .hub-music-container {
      width: 100%;
      display: flex;
      justify-content: center;
      margin-bottom: 16px;
    }
    .music-pill-box {
      background: var(--card-bg);
      border: 1px solid var(--border-color);
      border-radius: 30px;
      padding: 6px 16px;
      display: inline-flex;
      align-items: center;
      gap: 10px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.04);
    }
    .music-btn {
      width: 32px; height: 32px; border-radius: 50%; border: none;
      background: var(--primary-color); cursor: pointer; display: grid;
      place-items: center; font-size: 14px;
    }
    .music-label { font-size: 0.8rem; font-weight: 700; color: var(--text-color); }

    .layout-hub-classico { text-align: center; margin-bottom: 24px; }
    .hub-header { margin-bottom: 20px; }
    .hub-logo {
      width: 105px; height: 105px; border-radius: 50%; object-fit: cover;
      margin: 0 auto 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);
      border: 3px solid var(--primary-color); background: white;
    }
    .hub-title { font-size: 1.45rem; font-weight: 800; margin-bottom: 6px; }
    .hub-desc { font-size: 0.9rem; color: var(--text-muted); line-height: 1.4; margin-bottom: 16px; }

    .hub-buttons-list { display: flex; flex-direction: column; gap: 12px; }
    .hub-btn {
      display: flex; align-items: center; justify-content: center; gap: 12px;
      background: var(--card-bg); border: 2px solid var(--primary-color);
      color: var(--text-color); text-decoration: none; padding: 15px 20px;
      border-radius: 14px; font-weight: 700; font-size: 1rem; cursor: pointer;
      transition: transform .15s;
    }
    .hub-btn:active { transform: scale(0.98); }
    .hub-btn.highlight { background: var(--primary-color); color: #111827; }

    .hub-wifi-box {
      background: var(--card-bg);
      border: 2px solid var(--border-color);
      border-radius: 14px;
      padding: 16px 20px;
      margin-top: 25px;
      display: flex;
      flex-direction: column;
      gap: 12px;
      text-align: left;
    }
    .hub-wifi-header { display: flex; align-items: center; gap: 12px; }
    .hub-wifi-icon { font-size: 26px; }
    .hub-wifi-title { font-size: 0.95rem; font-weight: bold; color: var(--text-color); }
    .hub-wifi-sub { font-size: 0.8rem; color: var(--text-muted); }
    .hub-wifi-action {
      display: flex; justify-content: space-between; align-items: center;
      background: #f9fafb; border: 1px dashed var(--border-color);
      padding: 10px 14px; border-radius: 10px;
    }
    .hub-wifi-pass { font-family: monospace; font-size: 0.95rem; font-weight: bold; letter-spacing: 2px; }
    .hub-wifi-btn {
      background: var(--primary-color); color: #111827; border: none;
      border-radius: 6px; padding: 6px 12px; font-size: 0.8rem; font-weight: bold; cursor: pointer;
    }

    .topo-bar {
      display: flex; align-items: center; gap: 14px; margin-bottom: 16px;
      background: var(--card-bg); padding: 16px; border-radius: 16px; border: 1px solid var(--border-color);
    }
    .topo-logo { width: 60px; height: 60px; border-radius: 12px; object-fit: cover; }
    .abas-nav {
      display: flex; background: var(--card-bg); border-radius: 12px;
      border: 1px solid var(--border-color); overflow: hidden; margin-bottom: 16px;
    }
    .aba-btn {
      flex: 1; border: 0; background: transparent; padding: 12px;
      font-weight: bold; font-size: 0.85rem; cursor: pointer; color: var(--text-muted);
    }
    .aba-btn.active { color: var(--secondary-color); background: #faf5ff; border-bottom: 3px solid var(--secondary-color); }
    .box-aba-conteudo { background: var(--card-bg); border: 1px solid var(--border-color); border-radius: 14px; padding: 18px; margin-bottom: 16px; }

    .app-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px; }
    .app-brand { display: flex; align-items: center; gap: 12px; }
    .app-brand img { width: 48px; height: 48px; border-radius: 50%; object-fit: cover; }
    .app-quick-actions { display: grid; grid-template-columns: repeat(4, 1fr); gap: 8px; margin-bottom: 16px; }
    .app-action-chip {
      display: flex; flex-direction: column; align-items: center; justify-content: center;
      gap: 4px; padding: 10px 4px; background: var(--card-bg); border: 1px solid var(--border-color);
      border-radius: 12px; text-decoration: none; color: var(--text-color); font-size: 0.72rem; font-weight: bold;
    }

    .search-box { width: 100%; margin-bottom: 14px; }
    .search-box input {
      width: 100%; padding: 12px 16px; border-radius: 12px;
      border: 1px solid var(--border-color); font-size: 0.95rem; outline: none; background: var(--card-bg);
    }
    .chips-bar { display: flex; gap: 8px; overflow-x: auto; padding-bottom: 10px; margin-bottom: 16px; }
    .chips-bar::-webkit-scrollbar { display: none; }
    .chip-item {
      white-space: nowrap; padding: 7px 14px; border-radius: 20px;
      background: var(--card-bg); border: 1px solid var(--border-color);
      font-size: 0.8rem; font-weight: bold; cursor: pointer;
    }
    .chip-item.active { background: var(--secondary-color); color: white; border-color: var(--secondary-color); }

    .products-list { display: flex; flex-direction: column; gap: 12px; }
    .product-card {
      display: flex; background: var(--card-bg); border-radius: 14px;
      border: 1px solid var(--border-color); padding: 12px; gap: 12px;
    }
    .product-card img { width: 85px; height: 85px; border-radius: 10px; object-fit: cover; background: #eee; flex-shrink: 0; }
    .product-card-body { flex: 1; display: flex; flex-direction: column; justify-content: space-between; }
    .product-actions-row { display: flex; justify-content: space-between; align-items: center; margin-top: 8px; }

    .btn-add-cart {
      background: var(--primary-color); color: #111827; border: none;
      border-radius: 8px; padding: 7px 14px; font-weight: bold; font-size: 0.82rem; cursor: pointer;
    }
    .qty-counter { display: flex; align-items: center; gap: 8px; background: #f3f4f6; border-radius: 8px; padding: 3px 6px; }
    .qty-counter button { width: 26px; height: 26px; border: none; border-radius: 6px; background: white; font-weight: bold; cursor: pointer; }
    .qty-counter span { font-weight: bold; font-size: 0.9rem; min-width: 16px; text-align: center; }

    .floating-buttons-group {
      position: fixed;
      bottom: 85px;
      right: 20px;
      z-index: 1100;
    }

    .fab-btn {
      width: 52px;
      height: 52px;
      border-radius: 50%;
      background: #111827;
      color: var(--primary-color);
      border: 2px solid var(--primary-color);
      box-shadow: 0 8px 20px rgba(0,0,0,0.25);
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      transition: transform .2s, box-shadow .2s;
    }
    .fab-btn:hover { transform: scale(1.08); box-shadow: 0 10px 24px rgba(0,0,0,0.35); }
    .fab-btn svg { width: 24px; height: 24px; fill: currentColor; }

    .cart-floating-bar {
      display: none; position: fixed; bottom: 16px; left: 50%;
      transform: translateX(-50%); width: calc(100% - 32px); max-width: 580px;
      background: #111827; color: white; border-radius: 16px; padding: 14px 20px;
      box-shadow: 0 12px 30px rgba(0,0,0,0.35); z-index: 1200;
      justify-content: space-between; align-items: center; cursor: pointer;
    }
    .cart-floating-badge {
      background: var(--primary-color); color: #111827; width: 28px; height: 28px;
      border-radius: 50%; display: grid; place-items: center; font-weight: 800;
    }

    .modal-overlay {
      display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.65);
      z-index: 1150; padding: 16px; align-items: flex-end; justify-content: center;
    }
    .modal-overlay.active { display: flex; }
    .modal-content {
      background: white; width: 100%; max-width: 540px; max-height: 90vh;
      border-radius: 20px 20px 14px 14px; padding: 20px; overflow-y: auto;
      display: flex; flex-direction: column;
    }
    .modal-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 14px; }
    .close-btn { width: 32px; height: 32px; border-radius: 50%; border: none; background: #f3f4f6; font-weight: bold; cursor: pointer; }

    .cart-item-row { display: flex; justify-content: space-between; align-items: center; padding-bottom: 10px; border-bottom: 1px solid #f3f4f6; margin-bottom: 10px; }
    .cart-form-field { display: flex; flex-direction: column; gap: 6px; margin-bottom: 12px; }
    .cart-form-field label { font-size: 0.82rem; font-weight: 700; color: var(--text-muted); }
    .cart-form-field input, .cart-form-field select, .cart-form-field textarea {
      width: 100%; border: 1px solid var(--border-color); border-radius: 10px; padding: 10px 12px; outline: none; font-size: 0.92rem;
    }

    .form-row-2 { display: flex; gap: 10px; }
    .form-row-2 > div { flex: 1; }

    .payment-radios-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 8px; margin-top: 4px; }
    .payment-radio-label {
      border: 1px solid var(--border-color); border-radius: 10px; padding: 10px 8px;
      font-size: 0.8rem; font-weight: 600; display: flex; align-items: center; gap: 6px;
      cursor: pointer; background: #fff;
    }
    .payment-radio-label input { accent-color: var(--secondary-color); }

    .pix-box-area {
      background: #f0fdf4; border: 1px dashed var(--success-color);
      padding: 12px; border-radius: 10px; margin-top: 8px; margin-bottom: 12px;
    }
    .pix-box-row {
      display: flex; align-items: center; justify-content: space-between;
      background: white; border: 1px solid var(--border-color); padding: 8px 10px; border-radius: 8px; margin-top: 6px;
    }
    .pix-btn-copiar {
      background: var(--success-color); color: white; border: none; padding: 6px 12px; border-radius: 6px; font-weight: bold; font-size: 0.78rem; cursor: pointer;
    }

    .troco-box-area {
      background: #fffbeb; border: 1px solid #fef3c7; padding: 10px 12px; border-radius: 10px; margin-top: 8px; margin-bottom: 12px; display: none;
    }

    .totals-summary {
      background: #f8fafc; border: 1px solid var(--border-color); border-radius: 12px;
      padding: 12px; margin-bottom: 14px;
    }
    .totals-summary-row {
      display: flex; justify-content: space-between; font-size: 0.88rem; color: var(--text-muted); margin-bottom: 4px;
    }
    .totals-summary-row.total-destaque {
      font-size: 1.15rem; font-weight: 800; color: var(--secondary-color);
      border-top: 1px dashed var(--border-color); padding-top: 6px; margin-top: 6px;
    }

    .btn-send-whatsapp {
      background: var(--whatsapp-green); color: white; border: none; border-radius: 12px;
      padding: 15px; font-size: 1rem; font-weight: 800; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 10px;
    }

    .area-cardapio-impresso {
      display: none;
      width: 100%;
    }

    .folha-a4 {
      width: 210mm;
      min-height: 297mm;
      margin: 0 auto;
      background: var(--print-cor-fundo);
      padding: 12mm 15mm;
      box-shadow: 0 4px 15px rgba(0,0,0,0.12);
      color: #111;
      font-family: 'Roboto Condensed', sans-serif;
    }

    .print-m2-topo {
      display: flex;
      align-items: center;
      justify-content: space-between;
      border-bottom: 2px solid #ddd;
      padding-bottom: 10px;
      margin-bottom: 14px;
    }
    .print-m2-titulo {
      font-family: 'Montserrat', sans-serif;
      font-size: 20px;
      font-weight: 800;
      letter-spacing: 1px;
    }
    .print-m2-logo {
      width: 65px;
      height: 65px;
      border-radius: 50%;
      border: 2px solid var(--print-cor-primaria);
      object-fit: cover;
    }
    .print-m2-contato {
      background: var(--print-cor-primaria);
      color: var(--print-cor-secundaria);
      padding: 6px 12px;
      border-radius: 6px;
      font-weight: bold;
      font-size: 13px;
    }
    .print-m2-corpo {
      display: grid;
      grid-template-columns: 1.8fr 1fr;
      gap: 16px;
    }
    .print-m2-bloco { margin-bottom: 12px; page-break-inside: avoid; }
    .print-m2-faixa {
      background: var(--print-cor-primaria);
      color: var(--print-cor-secundaria);
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 4px 8px;
      border-radius: 3px;
      font-family: 'Montserrat', sans-serif;
      font-size: 12px;
      font-weight: 800;
      text-transform: uppercase;
    }
    .print-m2-badge {
      background: #000;
      color: #fff;
      width: 17px;
      height: 17px;
      border-radius: 50%;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-size: 9px;
      margin-right: 6px;
    }
    .print-m2-lista { list-style: none; padding: 4px 6px; }
    .print-m2-lista li {
      font-size: 11px;
      line-height: 1.4;
      border-bottom: 1px dashed #eee;
      padding: 3px 0;
      display: flex;
      justify-content: space-between;
    }
    .print-m2-aviso {
      background: #fff8e1;
      border: 1px dashed var(--print-cor-primaria);
      padding: 8px;
      text-align: center;
      font-size: 9.5px;
      font-weight: bold;
      border-radius: 4px;
      margin-bottom: 10px;
    }
    .print-m2-lateral-box {
      background: #fafafa;
      border: 1px solid #e8e8e8;
      border-radius: 5px;
      padding: 10px;
      font-size: 11px;
      text-align: center;
      margin-bottom: 10px;
    }

    .print-m1-topo {
      text-align: center;
      padding: 16px;
      background: var(--print-cor-primaria);
      color: var(--print-cor-secundaria);
      border-radius: 8px;
      margin-bottom: 18px;
      font-family: 'Poppins', sans-serif;
    }
    .print-m1-topo h1 { font-size: 22px; text-transform: uppercase; }
    .print-m1-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 12px;
    }
    .print-m1-card {
      border: 1.5px solid var(--print-cor-primaria);
      border-radius: 8px;
      padding: 12px;
      background: #fff;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }
    .print-m1-card h3 { font-family: 'Poppins', sans-serif; font-size: 14px; margin-bottom: 4px; }
    .print-m1-card p { font-size: 11px; color: #555; margin-bottom: 8px; }
    .print-m1-card .preco { font-size: 14px; font-weight: bold; color: var(--print-cor-primaria); }

    @media print {
      body {
        background: transparent !important;
        padding: 0 !important;
      }
      .main-wrapper, .floating-buttons-group, .cart-floating-bar, .modal-overlay {
        display: none !important;
      }
      .area-cardapio-impresso {
        display: block !important;
      }
      .folha-a4 {
        box-shadow: none !important;
        width: 100% !important;
        min-height: 100vh !important;
        padding: 6mm 10mm !important;
        margin: 0 !important;
      }
      * {
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
      }
    }
  </style>
</head>

<body>

  <div class="main-wrapper">

    <!-- 1. HUB CLÁSSICO -->
    <div id="layoutHubClassico" class="layout-hub-classico" style="display:none;">
      
      <div id="boxMusicaHub" class="hub-music-container" style="display:none;">
        <div class="music-pill-box">
          <button id="btnPlayMusica" class="music-btn" onclick="alternarAudio()">🎵</button>
          <span id="labelAudio" class="music-label">Música da Loja</span>
          <audio id="audioFundo" loop preload="auto">
            <source src="música.mp3" type="audio/mpeg">
            <source src="musica.mp3" type="audio/mpeg">
          </audio>
        </div>
      </div>

      <div class="hub-header">
        <img id="hubLogoImg" class="hub-logo" src="logo.png" alt="Logo">
        <h1 id="hubNomeLoja" class="hub-title">Carioca Ice Cream</h1>
        <p id="hubDescricaoLoja" class="hub-desc">Sorvetes artesanais e sobremesas deliciosas.</p>
      </div>

      <div class="hub-buttons-list">
        <button class="hub-btn highlight" onclick="abrirCardapioHub()">
          <span>🍨</span> Ver Cardápio & Fazer Pedido
        </button>
        <a id="btnHubWhats" href="#" target="_blank" class="hub-btn" onclick="iniciarMusicaSePermitido()">
          <span>💬</span> Falar no WhatsApp
        </a>
        <a id="btnHubInsta" href="#" target="_blank" class="hub-btn">
          <span>📸</span> Instagram da Loja
        </a>
        <a id="btnHubGoogle" href="#" target="_blank" class="hub-btn">
          <span>⭐</span> Avaliações Google
        </a>
        <a id="btnHubMaps" href="#" target="_blank" class="hub-btn">
          <span>📍</span> Como Chegar (Localização)
        </a>
      </div>

      <div id="boxWifiHub" class="hub-wifi-box" style="display:none;">
        <div class="hub-wifi-header">
          <div class="hub-wifi-icon">📶</div>
          <div>
            <div class="hub-wifi-title">Wi-Fi do Estabelecimento</div>
            <div class="hub-wifi-sub">Rede: <strong id="wifiNomeRede">Carioca_Clientes</strong></div>
          </div>
        </div>
        <div class="hub-wifi-action">
          <span id="wifiSenhaTexto" class="hub-wifi-pass">••••••••</span>
          <button id="btnVerWifi" type="button" class="hub-wifi-btn" onclick="alternarWifiSenha()">Ver Senha</button>
        </div>
      </div>

    </div>

    <!-- 2. VITRINE COM ABAS -->
    <div id="layoutVitrineAbas" class="layout-vitrine-abas" style="display:none;">
      <div class="topo-bar">
        <img id="abasLogoImg" class="topo-logo" src="logo.png" alt="Logo">
        <div style="flex:1;">
          <h2 id="abasNomeLoja" style="font-size:1.15rem;">Carioca Ice Cream</h2>
          <small id="abasEnderecoLoja" style="color:var(--text-muted);">Rio de Janeiro - RJ</small>
        </div>
      </div>

      <div class="abas-nav">
        <button class="aba-btn active" onclick="trocarAba(0)">🍽️ Cardápio</button>
        <button class="aba-btn" onclick="trocarAba(1)">ℹ️ Informações</button>
      </div>

      <div id="abaConteudoInfo" class="box-aba-conteudo" style="display:none;">
        <p style="margin-bottom:8px;"><strong id="infoSobre"></strong></p>
        <p style="margin-bottom:6px;">📍 <strong>Endereço:</strong> <span id="infoEndereco"></span></p>
        <p style="margin-bottom:6px;">📞 <strong>Telefone:</strong> <span id="infoTelefone"></span></p>
      </div>
    </div>

    <!-- 3. APP DELIVERY -->
    <div id="layoutAppDelivery" class="layout-app-delivery" style="display:none;">
      <div class="app-header">
        <div class="app-brand">
          <img id="appLogoImg" src="logo.png" alt="Logo">
          <div>
            <h2 id="appNomeLoja" style="font-size:1.1rem;">Carioca Ice Cream</h2>
            <small style="color:#16a34a; font-weight:bold;">● Aberto para Pedidos</small>
          </div>
        </div>
      </div>

      <div class="app-quick-actions">
        <a id="btnAppWhats" href="#" target="_blank" class="app-action-chip"><span>💬</span> Whats</a>
        <a id="btnAppInsta" href="#" target="_blank" class="app-action-chip"><span>📸</span> Insta</a>
        <a id="btnAppGoogle" href="#" target="_blank" class="app-action-chip"><span>⭐</span> Avaliar</a>
        <a id="btnAppMaps" href="#" target="_blank" class="app-action-chip"><span>📍</span> Mapa</a>
      </div>
    </div>

    <!-- CATÁLOGO DE PRODUTOS ONLINE -->
    <div id="catalogoProdutosContainer">
      <div class="search-box">
        <input type="text" id="campoBusca" placeholder="🔍 Buscar no cardápio..." oninput="filtrarProdutos()">
      </div>
      <div id="listaCategoriasChips" class="chips-bar"></div>
      <div id="gridProdutos" class="products-list"></div>
    </div>

  </div>

  <div class="floating-buttons-group">
    <button class="fab-btn" onclick="abrirModalCompartilhar()" title="Compartilhar / QR Code">
      <svg viewBox="0 0 24 24">
        <path d="M3 3h8v8H3V3zm2 2v4h4V5H5zm8-2h8v8h-8V3zm2 2v4h4V5h-4zM3 13h8v8H3v-8zm2 2v4h4v-4H5zm13-2h3v2h-3v-2zm-5 0h2v3h-2v-3zm2 3h3v2h-3v-2zm3 2h3v3h-3v-3zm-3 1h-2v2h2v-2zm5-1v2h1v-2h-1z"/>
      </svg>
    </button>
  </div>

  <!-- BARRA FLUTUANTE DO CARRINHO -->
  <div id="cartFloatingBar" class="cart-floating-bar" onclick="abrirModalCarrinho()">
    <div style="display:flex; align-items:center; gap:12px;">
      <div id="cartTotalItems" class="cart-floating-badge">0</div>
      <div>
        <div style="font-size:0.75rem; color:#9ca3af;">Meu Pedido</div>
        <div id="cartTotalPrice" style="font-weight:800;">R$ 0,00</div>
      </div>
    </div>
    <div style="color:var(--primary-color); font-weight:bold;">
      Ver Sacola ➔
    </div>
  </div>

  <!-- MODAL DO CARRINHO & CHECKOUT -->
  <div id="modalCarrinho" class="modal-overlay" style="z-index: 1300;">
    <div class="modal-content">
      <div class="modal-header">
        <h3>🛍️ Sacola & Checkout</h3>
        <button class="close-btn" onclick="fecharModalCarrinho()">&times;</button>
      </div>

      <div id="cartItemsList"></div>

      <div class="totals-summary">
        <div class="totals-summary-row">
          <span>Subtotal itens:</span>
          <span id="resumoSubtotal">R$ 0,00</span>
        </div>
        <div class="totals-summary-row">
          <span>Taxa de Entrega:</span>
          <span id="resumoTaxa">R$ 0,00</span>
        </div>
        <div class="totals-summary-row total-destaque">
          <span>Total:</span>
          <span id="resumoTotal">R$ 0,00</span>
        </div>
      </div>

      <div class="cart-form-field">
        <label>Seu Nome *</label>
        <input type="text" id="pedidoNomeCliente" placeholder="Como podemos te chamar?">
      </div>

      <div class="cart-form-field">
        <label>Tipo de Pedido</label>
        <select id="pedidoTipo" onchange="alternarCampoEndereco()">
          <option value="Entrega (Delivery)">Entrega (Delivery)</option>
          <option value="Retirar no Balcão">Retirar no Balcão</option>
        </select>
      </div>

      <div id="campoEnderecoBox">
        <div class="form-row-2">
          <div class="cart-form-field" style="flex: 2.5;">
            <label>Rua / Logradouro *</label>
            <input type="text" id="pedidoRua" placeholder="Ex: Rua Conde de Bonfim">
          </div>
          <div class="cart-form-field" style="flex: 1;">
            <label>Número *</label>
            <input type="text" id="pedidoNumero" placeholder="Ex: 123">
          </div>
        </div>

        <div class="form-row-2">
          <div class="cart-form-field">
            <label>Bairro (Rio de Janeiro) *</label>
            <select id="pedidoBairro" onchange="aoMudarBairro()">
              <option value="">Selecione seu bairro...</option>
            </select>
          </div>
          <div class="cart-form-field">
            <label>Complemento</label>
            <input type="text" id="pedidoComplemento" placeholder="Apto, Bloco, etc.">
          </div>
        </div>
      </div>

      <div class="cart-form-field">
        <label>Forma de Pagamento *</label>
        <div class="payment-radios-grid">
          <label class="payment-radio-label">
            <input type="radio" name="formaPagamentoOpcao" value="PIX Online" checked onchange="aoMudarPagamento()">
            <span>⚡ PIX Online</span>
          </label>
          <label class="payment-radio-label">
            <input type="radio" name="formaPagamentoOpcao" value="PIX na Máquina" onchange="aoMudarPagamento()">
            <span>💳 PIX na Máquina</span>
          </label>
          <label class="payment-radio-label">
            <input type="radio" name="formaPagamentoOpcao" value="Cartão de Crédito/Débito" onchange="aoMudarPagamento()">
            <span>💳 Cartão (Entrega)</span>
          </label>
          <label class="payment-radio-label">
            <input type="radio" name="formaPagamentoOpcao" value="Dinheiro" onchange="aoMudarPagamento()">
            <span>💵 Dinheiro</span>
          </label>
        </div>
      </div>

      <div id="blocoPixOnline" class="pix-box-area">
        <small style="color:#166534; font-weight:bold; display:block;">Chave PIX da Loja:</small>
        <div class="pix-box-row">
          <span id="textoChavePixExibida" style="font-size:0.85rem; font-weight:bold; color:#14532d; word-break:break-all;">Carregando chave...</span>
          <button type="button" class="pix-btn-copiar" onclick="copiarChavePixCheckout()">Copiar</button>
        </div>
        <small id="beneficiarioPixExibido" style="color:#15803d; font-size:0.75rem; display:block; margin-top:4px;"></small>
      </div>

      <div id="blocoTrocoDinheiro" class="troco-box-area">
        <label style="font-size:0.8rem; font-weight:700; color:#92400e; display:block; margin-bottom:4px;">Troco para quanto?</label>
        <input type="text" id="pedidoTroco" placeholder="Ex: R$ 50,00 (deixe em branco se não precisar)">
      </div>

      <div class="cart-form-field">
        <label>Observações do Pedido (opcional)</label>
        <textarea id="pedidoObservacao" rows="2" placeholder="Ex: Sem cebola, campainha quebrada..."></textarea>
      </div>

      <button class="btn-send-whatsapp" onclick="finalizarPedidoWhatsApp()">
        <span>💬</span> Finalizar Pedido no WhatsApp
      </button>
    </div>
  </div>

  <!-- MODAL DO CARDÁPIO (LAYOUT 1) -->
  <div id="modalHubCardapio" class="modal-overlay">
    <div class="modal-content" style="max-height:92vh;">
      <div class="modal-header">
        <h3>Cardápio Digital</h3>
        <button class="close-btn" onclick="fecharCardapioHub()">&times;</button>
      </div>
      <div id="modalHubContentArea" style="padding-bottom: 70px;"></div>
    </div>
  </div>

  <!-- MODAL DE COMPARTILHAMENTO / QR CODE -->
  <div id="modalCompartilhar" class="modal-overlay" style="z-index: 1400;">
    <div class="modal-content" style="text-align:center; align-items:center;">
      <div class="modal-header" style="width:100%;">
        <h3>📲 QR Code da Loja</h3>
        <button class="close-btn" onclick="fecharModalCompartilhar()">&times;</button>
      </div>

      <img id="imgQrCodeCliente" style="width:200px; height:200px; margin:15px auto; border-radius:12px; border:1px solid #e5e7eb;" src="" alt="QR Code">
      <p style="font-size:13px; color:#6b7280; margin-bottom:15px;">Aponte a câmera do seu celular para abrir o cardápio.</p>

      <div style="display:flex; gap:10px; width:100%;">
        <button class="hub-btn highlight" style="flex:1; padding:12px;" onclick="copiarLinkCliente()">Copiar Link</button>
        <button class="hub-btn" style="flex:1; padding:12px;" onclick="compartilharNativo()">Enviar</button>
      </div>
    </div>
  </div>

  <!-- ÁREA DA FOLHA IMPRESSA (A4) EXCLUSIVA DO PAINEL / PDF -->
  <div class="area-cardapio-impresso">
    <div class="folha-a4">
      <div id="printLayoutModelo2" style="display:none;">
        <header class="print-m2-topo">
          <div class="print-m2-titulo print-loja-nome">CARDÁPIO</div>
          <img class="print-m2-logo print-loja-logo" src="logo.png" alt="Logo">
          <div class="print-m2-contato print-loja-whats">📱 WhatsApp</div>
        </header>

        <div class="print-m2-corpo">
          <div id="printM2ColunaPrincipal"></div>
          <div>
            <div id="printM2ColunaSecundaria"></div>
            <div class="print-m2-aviso" id="printM2AvisoRodape">
              ADICIONAL DE 200g EM QUALQUER PORÇÃO: R$ 5,00
            </div>
            <div class="print-m2-lateral-box">
              <strong>FAÇA SEU PEDIDO</strong><br>
              <span class="print-loja-whats">(21) 99999-9999</span><br>
              <span id="printM2InstaText">@sualoja</span>
            </div>
            <div class="print-m2-lateral-box" style="font-size:9.5px; color:#666;">
              Aceitamos cartões de crédito, débito e Pix.
            </div>
          </div>
        </div>
      </div>

      <div id="printLayoutModelo1" style="display:none;">
        <header class="print-m1-topo">
          <h1 class="print-loja-nome">CARDÁPIO ESPECIAL</h1>
          <p class="print-loja-whats">📱 WhatsApp Pedidos</p>
        </header>
        <div class="print-m1-grid" id="printM1GradeProdutos"></div>
      </div>
    </div>
  </div>

  <script>
    let dadosLoja = {};
    let dadosRedes = {};
    let dadosAparencia = {};
    let dadosPix = {};
    let bairrosEntrega = [];
    let produtosLoja = [];
    let categoriaSelecionada = "todos";
    let carrinho = {};
    let taxaAtualEntrega = 0;

    let senhaWifiReal = "sorvete123";
    let wifiRevelado = false;

    const BAIRROS_FALLBACK = [
      { id: 1, nome: "Tijuca", taxa: 6.00 },
      { id: 2, nome: "Maracanã", taxa: 7.00 },
      { id: 3, nome: "Vila Isabel", taxa: 7.50 },
      { id: 4, nome: "Grajaú", taxa: 8.00 },
      { id: 5, nome: "Centro (RJ)", taxa: 10.00 },
      { id: 6, nome: "Botafogo", taxa: 12.00 },
      { id: 7, nome: "Copacabana", taxa: 14.00 }
    ];

    function carregarDados() {
      const lojaSalva = JSON.parse(localStorage.getItem("hubLoja") || "{}");
      dadosLoja = { ...(typeof loja !== 'undefined' ? loja : {}), ...lojaSalva };

      const redesSalvas = JSON.parse(localStorage.getItem("hubRedes") || "{}");
      dadosRedes = { ...(typeof loja !== 'undefined' && loja.contatos ? loja.contatos : {}), ...redesSalvas };

      dadosAparencia = JSON.parse(localStorage.getItem("hubAparencia") || "{}");
      if (dadosAparencia.principal) document.documentElement.style.setProperty("--primary-color", dadosAparencia.principal);
      if (dadosAparencia.secundaria) document.documentElement.style.setProperty("--secondary-color", dadosAparencia.secundaria);

      dadosPix = JSON.parse(localStorage.getItem("hubPix") || "{}");
      bairrosEntrega = JSON.parse(localStorage.getItem("hubBairros")) || BAIRROS_FALLBACK;

      const prodsSalvos = localStorage.getItem("hubProdutos");
      if (prodsSalvos) produtosLoja = JSON.parse(prodsSalvos);
      else if (typeof produtos !== 'undefined' && Array.isArray(produtos)) produtosLoja = produtos;
      else produtosLoja = [
        { id: "1", nome: "COMBO SOFRÊNCIA", categoria: "Combos", preco: 15.00, descricao: "250g batata frita + 250g mini salgados", disponivel: true, destaque: true },
        { id: "2", nome: "COMBO PEGAÇÃO", categoria: "Combos", preco: 27.00, descricao: "250g batata frita + salgados + calabresa", disponivel: true, destaque: true },
        { id: "3", nome: "Bolo de Pote", categoria: "Sobremesas", preco: 3.50, descricao: "Recheio cremoso", disponivel: true, destaque: false },
        { id: "4", nome: "Refrigerante Lata", categoria: "Bebidas", preco: 5.00, descricao: "350ml gelada", disponivel: true, destaque: false }
      ];

      popularTextosELinks();
      popularConfiguracoesCheckout();
      aplicarLayoutDefinidoPeloAdmin();
      renderizarCategorias();
      filtrarProdutos();
      atualizarCarrinhoVisual();
      gerarQrCodeCliente();

      const params = new URLSearchParams(window.location.search);
      if (params.get("print") === "true") {
        prepararFolhaImpressao();
        setTimeout(() => window.print(), 500);
      }
    }

    function popularTextosELinks() {
      const nome = dadosLoja.nome || "Carioca Ice Cream";
      const desc = dadosLoja.descricao || "Sorvetes artesanais e sobremesas deliciosas.";
      const enderecoPartes = [dadosLoja.endereco, dadosLoja.bairro, dadosLoja.cidade].filter(Boolean);
      const enderecoCompleto = enderecoPartes.length ? enderecoPartes.join(" • ") : "Rio de Janeiro - RJ";

      let rawWhats = (dadosLoja.whatsapp || dadosRedes.whatsapp || '21977138992').replace(/\D/g, '');
      if (rawWhats.length === 10 || rawWhats.length === 11) {
        rawWhats = '55' + rawWhats;
      }
      const whatsLink = `https://wa.me/${rawWhats}`;

      let insta = dadosRedes.instagram || 'cariocaicecream';
      if (!insta.startsWith("http")) insta = `https://instagram.com/${insta.replace("@", "")}`;

      const googleLink = dadosLoja.googleAvaliacoes || dadosRedes.googleAvaliacoes || 'https://maps.google.com';
      const mapaLink = dadosLoja.linkMapa || dadosRedes.linkMapa || 'https://maps.google.com';

      document.getElementById("hubNomeLoja").textContent = nome;
      document.getElementById("hubDescricaoLoja").textContent = desc;
      document.getElementById("btnHubWhats").href = whatsLink;
      document.getElementById("btnHubInsta").href = insta;
      document.getElementById("btnHubGoogle").href = googleLink;
      document.getElementById("btnHubMaps").href = mapaLink;

      document.getElementById("abasNomeLoja").textContent = nome;
      document.getElementById("abasEnderecoLoja").textContent = enderecoCompleto;
      document.getElementById("infoSobre").textContent = desc;
      document.getElementById("infoEndereco").textContent = enderecoCompleto;
      document.getElementById("infoTelefone").textContent = dadosLoja.telefone || "Não informado";

      document.getElementById("appNomeLoja").textContent = nome;
      document.getElementById("btnAppWhats").href = whatsLink;
      document.getElementById("btnAppInsta").href = insta;
      document.getElementById("btnAppGoogle").href = googleLink;
      document.getElementById("btnAppMaps").href = mapaLink;

      if (dadosLoja.logo) {
        document.getElementById("hubLogoImg").src = dadosLoja.logo;
        document.getElementById("abasLogoImg").src = dadosLoja.logo;
        document.getElementById("appLogoImg").src = dadosLoja.logo;
      }

      const nomeRede = dadosLoja.wifiRede || `${nome.replace(/\s+/g, '_')}_Clientes`;
      senhaWifiReal = dadosLoja.wifiSenha || "sorvete123";
      document.getElementById("wifiNomeRede").textContent = nomeRede;

      const audioUrl = dadosLoja.musicaUrl || (typeof loja !== 'undefined' ? loja.musicaUrl : "");
      if (audioUrl) {
        document.getElementById("audioFundo").src = audioUrl;
      }
    }

    function aplicarLayoutDefinidoPeloAdmin() {
      const modelo = dadosAparencia.modelo || "hub_classico";
      const l1 = document.getElementById("layoutHubClassico");
      const l2 = document.getElementById("layoutVitrineAbas");
      const l3 = document.getElementById("layoutAppDelivery");
      const catalogo = document.getElementById("catalogoProdutosContainer");
      const boxMusica = document.getElementById("boxMusicaHub");
      const boxWifi = document.getElementById("boxWifiHub");

      const wrapper = document.querySelector(".main-wrapper");
      if (catalogo.parentElement !== wrapper) {
        wrapper.appendChild(catalogo);
      }

      l1.style.display = "none";
      l2.style.display = "none";
      l3.style.display = "none";

      if (modelo === "hub_classico") {
        l1.style.display = "block";
        catalogo.style.display = "none";

        const exibirMusica = dadosLoja.exibirMusica !== false;
        const exibirWifi = dadosLoja.exibirWifi !== false;
        boxMusica.style.display = exibirMusica ? "flex" : "none";
        boxWifi.style.display = exibirWifi ? "flex" : "none";
      } else if (modelo === "vitrine_abas") {
        l2.style.display = "block";
        catalogo.style.display = "block";
        boxMusica.style.display = "none";
        boxWifi.style.display = "none";
      } else {
        l3.style.display = "block";
        catalogo.style.display = "block";
        boxMusica.style.display = "none";
        boxWifi.style.display = "none";
      }
    }

    function prepararFolhaImpressao() {
      const conf = JSON.parse(localStorage.getItem("hubImpressoConfig") || "{}");
      const modelo = conf.modelo || "modelo2";
      
      const cp = conf.primaria || "#f4b800";
      const cs = conf.secundaria || "#222222";
      const cf = conf.fundo || "#ffffff";

      document.documentElement.style.setProperty("--print-cor-primaria", cp);
      document.documentElement.style.setProperty("--print-cor-secundaria", cs);
      document.documentElement.style.setProperty("--print-cor-fundo", cf);

      const nomeLoja = dadosLoja.nome || "MEU ESTABELECIMENTO";
      const whatsLoja = dadosLoja.whatsapp || "(21) 99999-9999";

      document.querySelectorAll(".print-loja-nome").forEach(el => el.textContent = nomeLoja);
      document.querySelectorAll(".print-loja-whats").forEach(el => el.textContent = `📱 ${whatsLoja}`);
      if (dadosLoja.logo) {
        document.querySelectorAll(".print-loja-logo").forEach(el => el.src = dadosLoja.logo);
      }
      if (dadosRedes.instagram) {
        const instaEl = document.getElementById("printM2InstaText");
        if (instaEl) instaEl.textContent = dadosRedes.instagram;
      }
      if (conf.aviso) {
        const avEl = document.getElementById("printM2AvisoRodape");
        if (avEl) avEl.textContent = conf.aviso;
      }

      const m1 = document.getElementById("printLayoutModelo1");
      const m2 = document.getElementById("printLayoutModelo2");

      if (modelo === "modelo1") {
        m1.style.display = "block";
        m2.style.display = "none";
        renderizarImpressoModelo1();
      } else {
        m1.style.display = "none";
        m2.style.display = "block";
        renderizarImpressoModelo2();
      }
    }

    function renderizarImpressoModelo2() {
      const colPrincipal = document.getElementById("printM2ColunaPrincipal");
      const colSecundaria = document.getElementById("printM2ColunaSecundaria");
      colPrincipal.innerHTML = "";
      colSecundaria.innerHTML = "";

      const categorias = [...new Set(produtosLoja.map(p => p.categoria).filter(Boolean))];
      let indexBadge = 1;

      categorias.forEach((cat, idx) => {
        const itens = produtosLoja.filter(p => p.categoria === cat && p.disponivel !== false);
        if (itens.length === 0) return;

        const bloco = document.createElement("section");
        bloco.className = "print-m2-bloco";

        let precoTopo = "";
        if (itens.length === 1) precoTopo = `<span>R$ ${formatarMoeda(itens[0].preco)}</span>`;

        let html = `
          <div class="print-m2-faixa">
            <span><span class="print-m2-badge">${indexBadge++}</span> ${cat.toUpperCase()}</span>
            ${precoTopo}
          </div>
          <ul class="print-m2-lista">
        `;

        itens.forEach((p, subIdx) => {
          html += `
            <li>
              <span><strong>${indexBadge - 1}.${subIdx + 1}</strong> - ${p.nome} ${p.descricao ? `(${p.descricao})` : ''}</span>
              ${itens.length > 1 ? `<strong>R$ ${formatarMoeda(p.preco)}</strong>` : ''}
            </li>
          `;
        });

        html += `</ul>`;
        bloco.innerHTML = html;

        if (idx < 2) {
          colPrincipal.appendChild(bloco);
        } else {
          colSecundaria.appendChild(bloco);
        }
      });
    }

    function renderizarImpressoModelo1() {
      const grid = document.getElementById("printM1GradeProdutos");
      grid.innerHTML = "";

      const itens = produtosLoja.filter(p => p.disponivel !== false);
      itens.forEach(p => {
        const card = document.createElement("div");
        card.className = "print-m1-card";
        card.innerHTML = `
          <div>
            <h3>${p.nome}</h3>
            <p>${p.descricao || p.categoria}</p>
          </div>
          <div class="preco">R$ ${formatarMoeda(p.preco)}</div>
        `;
        grid.appendChild(card);
      });
    }

    window.addEventListener("storage", (e) => {
      if (e.key === "hubAparencia" || e.key === "hubLoja" || e.key === "hubProdutos" || e.key === "hubRedes" || e.key === "hubImpressoConfig") {
        carregarDados();
      }
    });

    function iniciarMusicaSePermitido() {
      const audio = document.getElementById("audioFundo");
      const btn = document.getElementById("btnPlayMusica");
      const label = document.getElementById("labelAudio");

      if (audio && audio.paused && dadosLoja.exibirMusica !== false) {
        audio.play().then(() => {
          if (btn) btn.textContent = "⏸️";
          if (label) label.textContent = "Tocando...";
        }).catch(() => {});
      }
    }

    function alternarAudio() {
      const audio = document.getElementById("audioFundo");
      const btn = document.getElementById("btnPlayMusica");
      const label = document.getElementById("labelAudio");

      if (audio.paused) {
        audio.play().then(() => {
          btn.textContent = "⏸️";
          label.textContent = "Tocando...";
        }).catch(() => {
          alert("Toque na tela para autorizar o áudio no seu navegador.");
        });
      } else {
        audio.pause();
        btn.textContent = "🎵";
        label.textContent = "Música da Loja";
      }
    }

    function alternarWifiSenha() {
      const passElem = document.getElementById("wifiSenhaTexto");
      const btn = document.getElementById("btnVerWifi");

      if (!wifiRevelado) {
        passElem.textContent = senhaWifiReal;
        btn.textContent = "Copiar";
        wifiRevelado = true;
      } else {
        navigator.clipboard.writeText(senhaWifiReal).then(() => {
          btn.textContent = "Copiado! ✓";
          setTimeout(() => { btn.textContent = "Copiar"; }, 2000);
        }).catch(() => {
          prompt("Copie a senha do Wi-Fi:", senhaWifiReal);
        });
      }
    }

    function abrirCardapioHub() {
      iniciarMusicaSePermitido();
      const catalogo = document.getElementById("catalogoProdutosContainer");
      document.getElementById("modalHubContentArea").appendChild(catalogo);
      catalogo.style.display = "block";
      document.getElementById("modalHubCardapio").classList.add("active");
    }

    function fecharCardapioHub() {
      document.getElementById("modalHubCardapio").classList.remove("active");
    }

    function trocarAba(idx) {
      const botoes = document.querySelectorAll(".aba-btn");
      botoes.forEach(b => b.classList.remove("active"));
      botoes[idx].classList.add("active");
      document.getElementById("catalogoProdutosContainer").style.display = idx === 0 ? "block" : "none";
      document.getElementById("abaConteudoInfo").style.display = idx === 1 ? "block" : "none";
    }

    function popularConfiguracoesCheckout() {
      const selectBairro = document.getElementById("pedidoBairro");
      selectBairro.innerHTML = '<option value="">Selecione seu bairro...</option>';
      bairrosEntrega.forEach(b => {
        const opt = document.createElement("option");
        opt.value = b.nome;
        opt.dataset.taxa = b.taxa;
        opt.textContent = `${b.nome} (Taxa: R$ ${formatarMoeda(b.taxa)})`;
        selectBairro.appendChild(opt);
      });

      const chave = dadosPix.chave || dadosLoja.chavePix || "Não configurada";
      const tipo = dadosPix.tipo || "PIX";
      document.getElementById("textoChavePixExibida").textContent = `${chave} (${tipo})`;
      if (dadosPix.favorecido) {
        document.getElementById("beneficiarioPixExibido").textContent = `Favorecido: ${dadosPix.favorecido}`;
      }
    }

    function renderizarCategorias() {
      const container = document.getElementById("listaCategoriasChips");
      container.innerHTML = "";
      const cats = ["todos", ...new Set(produtosLoja.map(p => p.categoria).filter(Boolean))];

      cats.forEach(c => {
        const b = document.createElement("button");
        b.className = `chip-item ${c === categoriaSelecionada ? "active" : ""}`;
        b.textContent = c === "todos" ? "Todos os Itens" : c;
        b.onclick = () => {
          categoriaSelecionada = c;
          document.querySelectorAll(".chip-item").forEach(el => el.classList.remove("active"));
          b.classList.add("active");
          filtrarProdutos();
        };
        container.appendChild(b);
      });
    }

    function formatarMoeda(v) { return Number(v || 0).toFixed(2).replace(".", ","); }

    function filtrarProdutos() {
      const busca = document.getElementById("campoBusca").value.toLowerCase().trim();
      const grid = document.getElementById("gridProdutos");
      grid.innerHTML = "";

      const filtrados = produtosLoja.filter(p => {
        const ativo = p.disponivel !== false;
        const cat = (categoriaSelecionada === "todos" || p.categoria === categoriaSelecionada);
        const match = (p.nome + " " + (p.descricao || "")).toLowerCase().includes(busca);
        return ativo && cat && match;
      });

      filtrados.forEach(p => {
        const card = document.createElement("div");
        card.className = "product-card";

        const qtd = carrinho[p.id] ? carrinho[p.id].qtd : 0;
        let acao = qtd > 0 
          ? `<div class="qty-counter"><button onclick="alterarQtd('${p.id}', -1)">-</button><span>${qtd}</span><button onclick="alterarQtd('${p.id}', 1)">+</button></div>`
          : `<button class="btn-add-cart" onclick="adicionarAoCarrinho('${p.id}')">+ Adicionar</button>`;

        card.innerHTML = `
          ${p.imagem ? `<img src="${p.imagem}" alt="${p.nome}">` : `<div style="width:85px;height:85px;border-radius:10px;background:#eee;display:grid;place-items:center;font-size:24px;">🍽️</div>`}
          <div class="product-card-body">
            <div>
              <strong style="display:block;font-size:0.95rem;">${p.nome}</strong>
              <small style="color:var(--text-muted);">${p.descricao || ""}</small>
            </div>
            <div class="product-actions-row">
              <strong style="font-size:1rem;">R$ ${formatarMoeda(p.preco)}</strong>
              ${acao}
            </div>
          </div>
        `;
        grid.appendChild(card);
      });
    }

    function adicionarAoCarrinho(id) {
      iniciarMusicaSePermitido();
      const prod = produtosLoja.find(p => String(p.id) === String(id));
      if (!prod) return;
      carrinho[id] = { produto: prod, qtd: 1 };
      atualizarCarrinhoVisual();
      filtrarProdutos();
    }

    function alterarQtd(id, delta) {
      if (!carrinho[id]) return;
      carrinho[id].qtd += delta;
      if (carrinho[id].qtd <= 0) delete carrinho[id];
      atualizarCarrinhoVisual();
      filtrarProdutos();
      renderizarItensCarrinho();
    }

    function calcularSubtotal() {
      return Object.values(carrinho).reduce((acc, i) => acc + (i.qtd * i.produto.preco), 0);
    }

    function atualizarCarrinhoVisual() {
      let totalQtd = 0;
      Object.values(carrinho).forEach(i => totalQtd += i.qtd);
      const subtotal = calcularSubtotal();
      const totalComFrete = subtotal > 0 ? (subtotal + taxaAtualEntrega) : 0;

      const barra = document.getElementById("cartFloatingBar");
      if (totalQtd > 0) {
        barra.style.display = "flex";
        document.getElementById("cartTotalItems").textContent = totalQtd;
        document.getElementById("cartTotalPrice").textContent = `R$ ${formatarMoeda(totalComFrete)}`;
      } else {
        barra.style.display = "none";
        fecharModalCarrinho();
      }

      document.getElementById("resumoSubtotal").textContent = `R$ ${formatarMoeda(subtotal)}`;
      document.getElementById("resumoTaxa").textContent = `R$ ${formatarMoeda(taxaAtualEntrega)}`;
      document.getElementById("resumoTotal").textContent = `R$ ${formatarMoeda(totalComFrete)}`;
    }

    function abrirModalCarrinho() {
      renderizarItensCarrinho();
      atualizarCarrinhoVisual();
      document.getElementById("modalCarrinho").classList.add("active");
    }

    function fecharModalCarrinho() {
      document.getElementById("modalCarrinho").classList.remove("active");
    }

    function renderizarItensCarrinho() {
      const cont = document.getElementById("cartItemsList");
      cont.innerHTML = "";
      Object.keys(carrinho).forEach(id => {
        const item = carrinho[id];
        const row = document.createElement("div");
        row.className = "cart-item-row";
        row.innerHTML = `
          <div>
            <strong>${item.produto.nome}</strong><br>
            <small style="color:var(--text-muted);">R$ ${formatarMoeda(item.produto.preco)} cada</small>
          </div>
          <div class="qty-counter">
            <button onclick="alterarQtd('${id}', -1)">-</button>
            <span>${item.qtd}</span>
            <button onclick="alterarQtd('${id}', 1)">+</button>
          </div>
        `;
        cont.appendChild(row);
      });
    }

    function alternarCampoEndereco() {
      const tipo = document.getElementById("pedidoTipo").value;
      const isEntrega = tipo.includes("Entrega");
      document.getElementById("campoEnderecoBox").style.display = isEntrega ? "block" : "none";
      if (!isEntrega) {
        taxaAtualEntrega = 0;
      } else {
        aoMudarBairro();
      }
      atualizarCarrinhoVisual();
    }

    function aoMudarBairro() {
      const select = document.getElementById("pedidoBairro");
      const opt = select.options[select.selectedIndex];
      if (opt && opt.dataset.taxa && document.getElementById("pedidoTipo").value.includes("Entrega")) {
        taxaAtualEntrega = parseFloat(opt.dataset.taxa);
      } else {
        taxaAtualEntrega = 0;
      }
      atualizarCarrinhoVisual();
    }

    function aoMudarPagamento() {
      const metodo = document.querySelector('input[name="formaPagamentoOpcao"]:checked').value;
      document.getElementById("blocoPixOnline").style.display = (metodo === "PIX Online") ? "block" : "none";
      document.getElementById("blocoTrocoDinheiro").style.display = (metodo === "Dinheiro") ? "block" : "none";
    }

    function copiarChavePixCheckout() {
      const chave = dadosPix.chave || dadosLoja.chavePix;
      if (!chave) { alert("Nenhuma chave PIX cadastrada!"); return; }
      navigator.clipboard.writeText(chave).then(() => {
        alert("Chave PIX copiada com sucesso!");
      }).catch(() => {
        prompt("Copie a chave PIX:", chave);
      });
    }

    function finalizarPedidoWhatsApp() {
      const chaves = Object.keys(carrinho);
      if (chaves.length === 0) {
        alert("Adicione itens à sacola antes de finalizar.");
        return;
      }

      const nome = document.getElementById("pedidoNomeCliente").value.trim();
      if (!nome) { alert("Por favor, informe seu nome."); return; }

      const tipo = document.getElementById("pedidoTipo").value;
      const isEntrega = tipo.includes("Entrega");

      let rua = "", numero = "", bairro = "", comp = "";
      if (isEntrega) {
        rua = document.getElementById("pedidoRua").value.trim();
        numero = document.getElementById("pedidoNumero").value.trim();
        bairro = document.getElementById("pedidoBairro").value.trim();
        comp = document.getElementById("pedidoComplemento").value.trim() || "Não informado";

        if (!rua || !numero || !bairro) {
          alert("Por favor, preencha Rua, Número e selecione o Bairro de entrega.");
          return;
        }
      }

      const formaPagamento = document.querySelector('input[name="formaPagamentoOpcao"]:checked').value;
      let detalhePagto = formaPagamento;
      if (formaPagamento === "Dinheiro") {
        const troco = document.getElementById("pedidoTroco").value.trim();
        detalhePagto += troco ? ` (Troco para: ${troco})` : " (Não precisa de troco)";
      } else if (formaPagamento === "PIX Online") {
        detalhePagto += " (Comprovante será anexado em seguida)";
      }

      const obs = document.getElementById("pedidoObservacao").value.trim();

      const subtotal = calcularSubtotal();
      const total = subtotal + taxaAtualEntrega;

      let txtItens = "";
      chaves.forEach(id => {
        const i = carrinho[id];
        const sub = i.qtd * i.produto.preco;
        txtItens += `• ${i.qtd}x ${i.produto.nome} - R$ ${formatarMoeda(sub)}\n`;
      });

      let msg = `*NOVO PEDIDO - ${dadosLoja.nome || "DELIVERY"}*\n`;
      msg += `----------------------------------------\n`;
      msg += `*Cliente:* ${nome}\n`;
      msg += `*Tipo:* ${tipo}\n\n`;

      msg += `*ITENS DO PEDIDO:*\n`;
      msg += txtItens;
      msg += `\n*Subtotal:* R$ ${formatarMoeda(subtotal)}\n`;
      if (isEntrega) {
        msg += `*Taxa de Entrega:* R$ ${formatarMoeda(taxaAtualEntrega)} (${bairro})\n`;
      }
      msg += `*TOTAL A PAGAR: R$ ${formatarMoeda(total)}*\n`;
      msg += `----------------------------------------\n`;

      if (isEntrega) {
        msg += `*ENDEREÇO DE ENTREGA (RJ):*\n`;
        msg += `Rua: ${rua}, Nº ${numero}\n`;
        msg += `Bairro: ${bairro} - Rio de Janeiro\n`;
        msg += `Complemento: ${comp}\n\n`;
      }

      msg += `*FORMA DE PAGAMENTO:*\n`;
      msg += `${detalhePagto}\n`;

      if (obs) {
        msg += `\n*Observações:*\n${obs}\n`;
      }

      msg += `----------------------------------------\n`;
      msg += `_Pedido gerado pelo Cardápio Online_`;

      let whats = (dadosLoja.whatsapp || dadosRedes.whatsapp || '21977138992').replace(/\D/g, '');
      if (whats.length === 10 || whats.length === 11) {
        whats = '55' + whats;
      }

      window.open(`https://wa.me/${whats}?text=${encodeURIComponent(msg)}`, '_blank');
    }

    function gerarQrCodeCliente() {
      const url = window.location.href;
      document.getElementById("imgQrCodeCliente").src = `https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=${encodeURIComponent(url)}`;
    }

    function abrirModalCompartilhar() {
      gerarQrCodeCliente();
      document.getElementById("modalCompartilhar").classList.add("active");
    }

    function fecharModalCompartilhar() {
      document.getElementById("modalCompartilhar").classList.remove("active");
    }

    function copiarLinkCliente() {
      navigator.clipboard.writeText(window.location.href).then(() => alert("Link copiado para a área de transferência!"));
    }

    function compartilharNativo() {
      if (navigator.share) {
        navigator.share({ title: dadosLoja.nome || "Cardápio Digital", url: window.location.href });
      } else {
        copiarLinkCliente();
      }
    }

    document.addEventListener("DOMContentLoaded", carregarDados);
  </script>
</body>

</html>
