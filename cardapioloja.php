<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Cardápio - Atendimento na Loja</title>

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

    .horario-badge-topo {
      background: #f1f5f9;
      border: 1px solid var(--border-color);
      border-radius: 20px;
      padding: 6px 14px;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      font-size: 0.8rem;
      font-weight: 700;
      color: #334155;
      margin-bottom: 12px;
    }

    .layout-hub-classico { text-align: center; margin-bottom: 24px; }
    .hub-header { margin-bottom: 16px; }
    .hub-logo {
      width: 105px; height: 105px; border-radius: 50%; object-fit: cover;
      margin: 0 auto 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);
      border: 3px solid var(--primary-color); background: white;
    }
    .hub-title { font-size: 1.45rem; font-weight: 800; margin-bottom: 4px; }
    .hub-desc { font-size: 0.9rem; color: var(--text-muted); line-height: 1.4; margin-bottom: 14px; }

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
      margin-top: 20px;
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
      position: fixed; bottom: 85px; right: 20px; z-index: 1100;
    }
    .fab-btn {
      width: 52px; height: 52px; border-radius: 50%; background: #111827; color: var(--primary-color);
      border: 2px solid var(--primary-color); box-shadow: 0 8px 20px rgba(0,0,0,0.25);
      display: flex; align-items: center; justify-content: center; cursor: pointer;
    }
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
      border-radius: 20px 20px 14px 14px; padding: 20px; overflow-y: auto; display: flex; flex-direction: column;
    }
    .modal-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 14px; }
    .close-btn { width: 32px; height: 32px; border-radius: 50%; border: none; background: #f3f4f6; font-weight: bold; cursor: pointer; }

    .cart-item-row { display: flex; justify-content: space-between; align-items: center; padding-bottom: 10px; border-bottom: 1px solid #f3f4f6; margin-bottom: 10px; }
    .cart-form-field { display: flex; flex-direction: column; gap: 6px; margin-bottom: 12px; }
    .cart-form-field label { font-size: 0.82rem; font-weight: 700; color: var(--text-muted); }
    .cart-form-field input, .cart-form-field textarea {
      width: 100%; border: 1px solid var(--border-color); border-radius: 10px; padding: 10px 12px; outline: none; font-size: 0.92rem;
    }

    .payment-radios-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 8px; margin-top: 4px; }
    .payment-radio-label {
      border: 1px solid var(--border-color); border-radius: 10px; padding: 10px 8px;
      font-size: 0.8rem; font-weight: 600; display: flex; align-items: center; gap: 6px;
      cursor: pointer; background: #fff; justify-content: center;
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

    .aviso-caixa-box {
      background: #eff6ff; border: 1px dashed #3b82f6;
      padding: 12px; border-radius: 10px; margin-top: 8px; margin-bottom: 12px; display: none;
      color: #1e40af; font-size: 0.85rem; font-weight: 600; text-align: center;
    }

    .totals-summary {
      background: #f8fafc; border: 1px solid var(--border-color); border-radius: 12px; padding: 12px; margin-bottom: 14px;
    }
    .totals-summary-row.total-destaque {
      font-size: 1.15rem; font-weight: 800; color: var(--secondary-color); display: flex; justify-content: space-between;
    }

    .btn-send-whatsapp {
      background: var(--whatsapp-green); color: white; border: none; border-radius: 12px;
      padding: 15px; font-size: 1rem; font-weight: 800; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 10px;
    }
  </style>
</head>

<body>

  <div class="main-wrapper">

    <!-- 1. HUB CLÁSSICO REORGANIZADO -->
    <div id="layoutHubClassico" class="layout-hub-classico" style="display:none;">
      
      <div id="badgeHorarioLoja" class="horario-badge-topo">
        <span>🕒</span> <span id="textoHorarioLoja">Aberto hoje das 13:00 às 21:00</span>
      </div>

      <div class="hub-header">
        <img id="hubLogoImg" class="hub-logo" src="logo.png" alt="Logo">
        <h1 id="hubNomeLoja" class="hub-title">Carioca Ice Cream</h1>
        <p id="hubDescricaoLoja" class="hub-desc">Cardápio de Balcão e Mesa.</p>
      </div>

      <div class="hub-buttons-list">
        <button class="hub-btn highlight" onclick="abrirCardapioHub()">
          <span>🍨</span> Ver Cardápio & Fazer Pedido
        </button>
        <a id="btnHubInsta" href="#" target="_blank" class="hub-btn">
          <span>📸</span> Instagram da Loja
        </a>
        <a id="btnHubGoogle" href="#" target="_blank" class="hub-btn">
          <span>⭐</span> Avaliações no Google
        </a>
      </div>

      <div id="boxWifiHub" class="hub-wifi-box">
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
          <small id="abasEnderecoLoja" style="color:var(--text-muted);">Atendimento Presencial</small>
        </div>
      </div>

      <div class="abas-nav">
        <button class="aba-btn active" onclick="trocarAba(0)">🍽️ Cardápio</button>
        <button class="aba-btn" onclick="trocarAba(1)">ℹ️ Informações</button>
      </div>

      <div id="abaConteudoInfo" class="box-aba-conteudo" style="display:none;">
        <p style="margin-bottom:8px;"><strong id="infoSobre"></strong></p>
        <p style="margin-bottom:6px;">📍 <strong>Local:</strong> Consumo no estabelecimento</p>
        <p style="margin-bottom:6px;">🕒 <strong>Horário:</strong> <span id="infoHorario">13:00 às 21:00</span></p>
      </div>
    </div>

    <!-- 3. APP DELIVERY -->
    <div id="layoutAppDelivery" class="layout-app-delivery" style="display:none;">
      <div class="app-header">
        <div class="app-brand">
          <img id="appLogoImg" src="logo.png" alt="Logo">
          <div>
            <h2 id="appNomeLoja" style="font-size:1.1rem;">Carioca Ice Cream</h2>
            <small style="color:#16a34a; font-weight:bold;">● Atendimento no Balcão</small>
          </div>
        </div>
      </div>
    </div>

    <!-- CATÁLOGO DE PRODUTOS COMPARTILHADO -->
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
    <div style="color:var(--primary-color); font-weight:bold;">Ver Pedido ➔</div>
  </div>

  <!-- MODAL DO CHECKOUT -->
  <div id="modalCarrinho" class="modal-overlay" style="z-index: 1300;">
    <div class="modal-content">
      <div class="modal-header">
        <h3>🛍️ Finalizar Pedido no Balcão</h3>
        <button class="close-btn" onclick="fecharModalCarrinho()">&times;</button>
      </div>

      <div id="cartItemsList"></div>

      <div class="totals-summary">
        <div class="totals-summary-row total-destaque">
          <span>Total a Pagar:</span>
          <span id="resumoTotal">R$ 0,00</span>
        </div>
      </div>

      <div class="cart-form-field">
        <label>Seu Nome *</label>
        <input type="text" id="pedidoNomeCliente" placeholder="Digite seu nome">
      </div>

      <div class="cart-form-field">
        <label>Forma de Pagamento *</label>
        <div class="payment-radios-grid">
          <label class="payment-radio-label">
            <input type="radio" name="formaPagamentoOpcao" value="PIX" checked onchange="aoMudarPagamento()">
            <span>⚡ PIX</span>
          </label>
          <label class="payment-radio-label">
            <input type="radio" name="formaPagamentoOpcao" value="Dinheiro" onchange="aoMudarPagamento()">
            <span>💵 Dinheiro</span>
          </label>
          <label class="payment-radio-label">
            <input type="radio" name="formaPagamentoOpcao" value="Cartão" onchange="aoMudarPagamento()">
            <span>💳 Cartão</span>
          </label>
        </div>
      </div>

      <div id="blocoPixOnline" class="pix-box-area">
        <small style="color:#166534; font-weight:bold; display:block;">Chave PIX da Loja:</small>
        <div class="pix-box-row">
          <span id="textoChavePixExibida" style="font-size:0.85rem; font-weight:bold; color:#14532d; word-break:break-all;">Carregando...</span>
          <button type="button" class="pix-btn-copiar" onclick="copiarChavePixCheckout()">Copiar</button>
        </div>
        <small id="beneficiarioPixExibido" style="color:#15803d; font-size:0.75rem; display:block; margin-top:4px;"></small>
        <small style="color:#166534; font-weight:600; display:block; margin-top:6px;">⚠️ Após o pagamento, apresente o comprovante no balcão.</small>
      </div>

      <div id="blocoAvisoCaixa" class="aviso-caixa-box">
        ℹ️ Ao finalizar o pedido, dirija-se ao caixa para concluir o pagamento.
      </div>

      <div class="cart-form-field">
        <label>Observações do Pedido (opcional)</label>
        <textarea id="pedidoObservacao" rows="2" placeholder="Ex: Sem cebola, ponto da carne..."></textarea>
      </div>

      <button class="btn-send-whatsapp" onclick="finalizarPedidoBalcaoWhatsApp()">
        <span>🛎️</span> Enviar Pedido para o Balcão
      </button>
    </div>
  </div>

  <!-- MODAL DO CARDÁPIO (HUB) -->
  <div id="modalHubCardapio" class="modal-overlay">
    <div class="modal-content" style="max-height:92vh;">
      <div class="modal-header">
        <h3>Cardápio da Loja</h3>
        <button class="close-btn" onclick="fecharCardapioHub()">&times;</button>
      </div>
      <div id="modalHubContentArea" style="padding-bottom: 70px;"></div>
    </div>
  </div>

  <!-- MODAL QR CODE -->
  <div id="modalCompartilhar" class="modal-overlay" style="z-index: 1400;">
    <div class="modal-content" style="text-align:center; align-items:center;">
      <div class="modal-header" style="width:100%;">
        <h3>📲 QR Code da Loja</h3>
        <button class="close-btn" onclick="fecharModalCompartilhar()">&times;</button>
      </div>

      <img id="imgQrCodeCliente" style="width:200px; height:200px; margin:15px auto; border-radius:12px; border:1px solid #e5e7eb;" src="" alt="QR Code">
      <p style="font-size:13px; color:#6b7280; margin-bottom:15px;">Aponte a câmera para pedir direto do balcão ou mesa.</p>

      <div style="display:flex; gap:10px; width:100%;">
        <button class="hub-btn highlight" style="flex:1; padding:12px;" onclick="copiarLinkCliente()">Copiar Link</button>
        <button class="hub-btn" style="flex:1; padding:12px;" onclick="compartilharNativo()">Enviar</button>
      </div>
    </div>
  </div>

  <script>
    let dadosLoja = {};
    let dadosRedes = {};
    let dadosAparencia = {};
    let dadosPix = {};
    let produtosLoja = [];
    let categoriaSelecionada = "todos";
    let carrinho = {};

    let senhaWifiReal = "sorvete123";
    let wifiRevelado = false;

    function obterHorarioHojeFormatado(loja) {
      if (!loja.horarios) return "Aberto hoje das 13:00 às 21:00";
      const diasSemana = ["dom", "seg", "ter", "qua", "qui", "sex", "sab"];
      const hoje = diasSemana[new Date().getDay()];
      const configHoje = loja.horarios[hoje];

      if (configHoje && !configHoje.aberto) {
        return "Fechado hoje";
      } else if (configHoje && configHoje.abre && configHoje.fecha) {
        return `Aberto hoje das ${configHoje.abre} às ${configHoje.fecha}`;
      }
      return "Aberto hoje das 13:00 às 21:00";
    }

    function carregarDados() {
      const lojaSalva = JSON.parse(localStorage.getItem("hubLoja") || "{}");
      dadosLoja = { ...(typeof loja !== 'undefined' ? loja : {}), ...lojaSalva };

      const redesSalvas = JSON.parse(localStorage.getItem("hubRedes") || "{}");
      dadosRedes = { ...(typeof loja !== 'undefined' && loja.contatos ? loja.contatos : {}), ...redesSalvas };

      dadosAparencia = JSON.parse(localStorage.getItem("hubAparencia") || "{}");
      if (dadosAparencia.principal) document.documentElement.style.setProperty("--primary-color", dadosAparencia.principal);
      if (dadosAparencia.secundaria) document.documentElement.style.setProperty("--secondary-color", dadosAparencia.secundaria);

      dadosPix = JSON.parse(localStorage.getItem("hubPix") || "{}");

      const prodsLojaFisica = localStorage.getItem("hubProdutosLoja");
      const prodsGerais = localStorage.getItem("hubProdutos");

      if (prodsLojaFisica) {
        produtosLoja = JSON.parse(prodsLojaFisica);
      } else if (prodsGerais) {
        produtosLoja = JSON.parse(prodsGerais);
      } else if (typeof produtos !== 'undefined' && Array.isArray(produtos)) {
        produtosLoja = produtos;
      } else {
        produtosLoja = [
          { id: "1", nome: "COMBO DO DIA", categoria: "Promoções", preco: 19.90, descricao: "Sorvete duplo + cascata", disponivel: true, destaque: true },
          { id: "2", nome: "COMBO FAMÍLIA", categoria: "Combos", preco: 39.90, descricao: "Pote 1L + 4 casquinhas", disponivel: true, destaque: true }
        ];
      }

      popularTextosELinks();
      popularConfiguracoesCheckout();
      aplicarLayoutLojaFisica();
      renderizarCategorias();
      filtrarProdutos();
      atualizarCarrinhoVisual();
      gerarQrCodeCliente();
    }

    function popularTextosELinks() {
      const nome = dadosLoja.nome || "Carioca Ice Cream";
      const desc = dadosLoja.descricao || "Sorvetes artesanais e sobremesas deliciosas.";

      document.getElementById("hubNomeLoja").textContent = nome;
      document.getElementById("hubDescricaoLoja").textContent = desc;

      let insta = dadosRedes.instagram || 'cariocaicecream';
      if (!insta.startsWith("http")) insta = `https://instagram.com/${insta.replace("@", "")}`;
      document.getElementById("btnHubInsta").href = insta;

      const googleLink = dadosRedes.googleAvaliacoes || dadosLoja.googleAvaliacoes || 'https://maps.google.com';
      document.getElementById("btnHubGoogle").href = googleLink;

      const textoHorario = obterHorarioHojeFormatado(dadosLoja);
      document.getElementById("textoHorarioLoja").textContent = textoHorario;
      const elInfoH = document.getElementById("infoHorario");
      if (elInfoH) elInfoH.textContent = textoHorario;

      document.getElementById("abasNomeLoja").textContent = nome;
      document.getElementById("infoSobre").textContent = desc;

      document.getElementById("appNomeLoja").textContent = nome;

      if (dadosLoja.logo) {
        document.getElementById("hubLogoImg").src = dadosLoja.logo;
        document.getElementById("abasLogoImg").src = dadosLoja.logo;
        document.getElementById("appLogoImg").src = dadosLoja.logo;
      }

      const nomeRede = dadosLoja.wifiRede || `${nome.replace(/\s+/g, '_')}_Clientes`;
      senhaWifiReal = dadosLoja.wifiSenha || "sorvete123";
      document.getElementById("wifiNomeRede").textContent = nomeRede;
    }

    function aplicarLayoutLojaFisica() {
      const modelo = localStorage.getItem("hubModeloLoja") || "hub_classico";

      const l1 = document.getElementById("layoutHubClassico");
      const l2 = document.getElementById("layoutVitrineAbas");
      const l3 = document.getElementById("layoutAppDelivery");
      const catalogo = document.getElementById("catalogoProdutosContainer");

      const wrapper = document.querySelector(".main-wrapper");
      if (catalogo.parentElement !== wrapper) wrapper.appendChild(catalogo);

      l1.style.display = "none";
      l2.style.display = "none";
      l3.style.display = "none";

      if (modelo === "hub_classico") {
        l1.style.display = "block";
        catalogo.style.display = "none";
      } else if (modelo === "vitrine_abas") {
        l2.style.display = "block";
        catalogo.style.display = "block";
      } else {
        l3.style.display = "block";
        catalogo.style.display = "block";
      }
    }

    function popularConfiguracoesCheckout() {
      const chave = dadosPix.chave || dadosLoja.chavePix || "Chave não configurada";
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
          ${p.imagem ? `<img src="${p.imagem}" alt="${p.nome}">` : `<div style="width:85px;height:85px;border-radius:10px;background:#eee;display:grid;place-items:center;font-size:24px;">🍦</div>`}
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

    function calcularTotal() {
      return Object.values(carrinho).reduce((acc, i) => acc + (i.qtd * i.produto.preco), 0);
    }

    function atualizarCarrinhoVisual() {
      let totalQtd = 0;
      Object.values(carrinho).forEach(i => totalQtd += i.qtd);
      const total = calcularTotal();

      const barra = document.getElementById("cartFloatingBar");
      if (totalQtd > 0) {
        barra.style.display = "flex";
        document.getElementById("cartTotalItems").textContent = totalQtd;
        document.getElementById("cartTotalPrice").textContent = `R$ ${formatarMoeda(total)}`;
      } else {
        barra.style.display = "none";
        fecharModalCarrinho();
      }

      document.getElementById("resumoTotal").textContent = `R$ ${formatarMoeda(total)}`;
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

    function aoMudarPagamento() {
      const metodo = document.querySelector('input[name="formaPagamentoOpcao"]:checked').value;
      const blocoPix = document.getElementById("blocoPixOnline");
      const blocoAviso = document.getElementById("blocoAvisoCaixa");

      if (metodo === "PIX") {
        blocoPix.style.display = "block";
        blocoAviso.style.display = "none";
      } else {
        blocoPix.style.display = "none";
        blocoAviso.style.display = "block";
        blocoAviso.textContent = `ℹ️ Pagamento em ${metodo}: Por favor, dirija-se ao caixa para concluir o pagamento.`;
      }
    }

    function copiarChavePixCheckout() {
      const chave = dadosPix.chave || dadosLoja.chavePix;
      if (!chave) { alert("Nenhuma chave PIX cadastrada!"); return; }
      navigator.clipboard.writeText(chave).then(() => {
        alert("Chave PIX copiada!");
      }).catch(() => {
        prompt("Copie a chave PIX:", chave);
      });
    }

    function finalizarPedidoBalcaoWhatsApp() {
      const chaves = Object.keys(carrinho);
      if (chaves.length === 0) { alert("Adicione itens antes de finalizar."); return; }

      const nome = document.getElementById("pedidoNomeCliente").value.trim();
      if (!nome) { alert("Por favor, digite seu nome."); return; }

      const formaPagamento = document.querySelector('input[name="formaPagamentoOpcao"]:checked').value;
      const obs = document.getElementById("pedidoObservacao").value.trim();
      const total = calcularTotal();

      if (formaPagamento === "PIX") {
        alert("Atenção: Apresente o comprovante do PIX no balcão.");
      } else {
        alert("Por favor, dirija-se ao caixa para efetuar o pagamento.");
      }

      let txtItens = "";
      chaves.forEach(id => {
        const i = carrinho[id];
        txtItens += `• ${i.qtd}x ${i.produto.nome} - R$ ${formatarMoeda(i.qtd * i.produto.preco)}\n`;
      });

      let msg = `*🛎️ PEDIDO NA LOJA (BALCÃO / COZINHA)*\n`;
      msg += `----------------------------------------\n`;
      msg += `*Cliente:* ${nome}\n`;
      msg += `*Local:* Consumo no Estabelecimento\n\n`;
      msg += `*ITENS:*\n${txtItens}\n`;
      msg += `*TOTAL: R$ ${formatarMoeda(total)}*\n`;
      msg += `----------------------------------------\n`;
      msg += `*PAGAMENTO:* ${formaPagamento}\n`;
      if (obs) msg += `\n*Observações:*\n${obs}\n`;
      msg += `----------------------------------------\n`;
      msg += `_Pedido gerado via Cardápio Local_`;

      const whatsCozinha = localStorage.getItem("hubTelefoneCozinha") || dadosLoja.whatsappBalcao || dadosLoja.whatsapp || '21977138992';
      let whatsLimpo = whatsCozinha.replace(/\D/g, '');
      if (whatsLimpo.length === 10 || whatsLimpo.length === 11) whatsLimpo = '55' + whatsLimpo;

      window.open(`https://wa.me/${whatsLimpo}?text=${encodeURIComponent(msg)}`, '_blank');
    }

    function abrirCardapioHub() {
      const catalogo = document.getElementById("catalogoProdutosContainer");
      document.getElementById("modalHubContentArea").appendChild(catalogo);
      catalogo.style.display = "block";
      document.getElementById("modalHubCardapio").classList.add("active");
    }

    function fecharCardapioHub() { document.getElementById("modalHubCardapio").classList.remove("active"); }

    function trocarAba(idx) {
      const botoes = document.querySelectorAll(".aba-btn");
      botoes.forEach(b => b.classList.remove("active"));
      botoes[idx].classList.add("active");
      document.getElementById("catalogoProdutosContainer").style.display = idx === 0 ? "block" : "none";
      document.getElementById("abaConteudoInfo").style.display = idx === 1 ? "block" : "none";
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
          btn.textContent = "Copiado!";
          setTimeout(() => { btn.textContent = "Copiar"; }, 2000);
        });
      }
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
        navigator.share({ title: dadosLoja.nome || "Cardápio Loja", url: window.location.href });
      } else {
        copiarLinkCliente();
      }
    }

    window.addEventListener("storage", (e) => {
      if (["hubAparencia", "hubModeloLoja", "hubLoja", "hubProdutosLoja", "hubTelefoneCozinha", "hubRedes"].includes(e.key)) {
        carregarDados();
      }
    });

    document.addEventListener("DOMContentLoaded", carregarDados);
  </script>
</body>

</html>
