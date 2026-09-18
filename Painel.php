<?php
session_start();

if (!isset($_SESSION['usuario_logado']) || $_SESSION['usuario_logado'] !== true) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lauanne Connect | Painel Administrativo</title>

    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: Arial, Helvetica, sans-serif; background: #f5f6f8; color: #202124; }
        button, input, textarea, select { font-family: inherit; }
        .app { display: flex; min-height: 100vh; }

        .sidebar {
            width: 250px; background: #111827; color: white; padding: 25px 15px;
            position: fixed; left: 0; top: 0; bottom: 0; overflow-y: auto;
            display: flex; flex-direction: column; justify-content: space-between;
        }
        .brand { padding: 5px 10px 25px; }
        .brand h1 { font-size: 20px; letter-spacing: .5px; margin-bottom: 5px; color: #00ff66; font-family: monospace; }
        .brand p { font-size: 12px; color: #9ca3af; }
        .menu { display: flex; flex-direction: column; gap: 5px; }
        .menu button {
            width: 100%; border: 0; background: transparent; color: #d1d5db; text-align: left;
            padding: 12px 14px; border-radius: 9px; cursor: pointer; font-size: 13.5px;
            display: flex; align-items: center; gap: 11px; transition: .2s;
        }
        .menu button:hover { background: #1f2937; color: white; }
        .menu button.active { background: #facc15; color: #111827; font-weight: bold; }
        .menu-icon { width: 19px; height: 19px; flex-shrink: 0; }
        
        .sidebar-bottom { margin-top: auto; padding-top: 20px; border-top: 1px solid rgba(255,255,255,0.08); }
        .btn-logout {
            width: 100%; border: 1px solid rgba(239, 68, 68, 0.3); background: rgba(239, 68, 68, 0.1); 
            color: #ef4444; text-align: left; padding: 11px 14px; border-radius: 9px; 
            cursor: pointer; font-size: 13.5px; display: flex; align-items: center; gap: 11px; 
            text-decoration: none; font-weight: bold; transition: .2s;
        }
        .btn-logout:hover { background: #ef4444; color: white; }
        .sidebar-footer { font-size: 11px; color: #6b7280; margin-top: 12px; text-align: center; }

        .content { margin-left: 250px; width: calc(100% - 250px); padding: 30px; }
        .topbar {
            background: white; border-radius: 14px; padding: 20px 25px; margin-bottom: 25px;
            display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 10px rgba(0,0,0,.05);
        }
        .topbar h2 { font-size: 23px; }
        .status { display: flex; align-items: center; gap: 8px; font-size: 13px; color: #16a34a; }
        .status-dot { width: 9px; height: 9px; background: #22c55e; border-radius: 50%; }

        .section { display: none; }
        .section.active { display: block; }
        .card { background: white; border-radius: 14px; padding: 25px; margin-bottom: 20px; box-shadow: 0 2px 10px rgba(0,0,0,.05); }
        .card-header { margin-bottom: 20px; }
        .card-header h3 { font-size: 19px; margin-bottom: 5px; }
        .card-header p { font-size: 14px; color: #6b7280; }

        .stats { display: grid; grid-template-columns: repeat(4, 1fr); gap: 18px; margin-bottom: 20px; }
        .stat { background: white; padding: 22px; border-radius: 14px; box-shadow: 0 2px 10px rgba(0,0,0,.05); }
        .stat span { font-size: 13px; color: #6b7280; }
        .stat strong { display: block; margin-top: 8px; font-size: 28px; }

        .products-toolbar { display: flex; justify-content: space-between; align-items: center; gap: 15px; margin-bottom: 20px; }
        .search-box { flex: 1; }
        .search-box input { width: 100%; border: 1px solid #d1d5db; border-radius: 9px; padding: 12px 14px; font-size: 14px; outline: none; }
        .search-box input:focus { border-color: #facc15; }

        .product-list { display: grid; gap: 12px; }
        .product {
            border: 1px solid #e5e7eb; border-radius: 11px; padding: 15px; display: flex;
            justify-content: space-between; align-items: center; gap: 15px; transition: .2s;
        }
        .product:hover { box-shadow: 0 3px 12px rgba(0,0,0,.06); }
        .product-info { display: flex; align-items: center; gap: 15px; min-width: 0; }
        .product-image { width: 70px; height: 70px; border-radius: 10px; object-fit: cover; background: #f3f4f6; flex-shrink: 0; }
        .product-info h4 { margin-bottom: 5px; font-size: 16px; }
        .product-info p { font-size: 13px; color: #6b7280; margin-bottom: 4px; }
        .product-price { font-weight: bold; }
        .product-actions { display: flex; gap: 6px; flex-shrink: 0; flex-wrap: wrap; align-items: center; }

        .btn {
            border: 0; border-radius: 8px; padding: 9px 13px; cursor: pointer; font-weight: bold;
            font-size: 13px; display: inline-flex; align-items: center; justify-content: center;
            gap: 6px; transition: .15s ease; text-decoration: none;
        }
        .btn-sm { padding: 6px 10px; font-size: 12px; }
        .btn-primary { background: #facc15; color: #111827; }
        .btn-secondary { background: #e5e7eb; color: #374151; }
        .btn-danger { background: #fee2e2; color: #b91c1c; }
        .btn-whatsapp { background: #25d366; color: white; }

        .form-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 18px; }
        .field { display: flex; flex-direction: column; gap: 7px; }
        .field.full { grid-column: 1 / -1; }
        .field label { font-size: 13px; font-weight: bold; }
        .field input, .field textarea, .field select {
            width: 100%; border: 1px solid #d1d5db; border-radius: 8px; padding: 11px 12px;
            font-size: 14px; outline: none; background: white;
        }
        .field textarea { min-height: 100px; resize: vertical; }
        .field input:focus, .field textarea:focus, .field select:focus { border-color: #facc15; }
        .actions { margin-top: 22px; display: flex; gap: 10px; }

        .horarios-semana { border: 1px solid #e5e7eb; border-radius: 12px; overflow: hidden; background: #fff; }
        .horario-cabecalho, .horario-linha { display: grid; grid-template-columns: minmax(150px, 1.5fr) 80px 1fr 1fr; align-items: center; gap: 12px; padding: 12px 15px; }
        .horario-cabecalho { background: #f9fafb; color: #6b7280; font-size: 12px; font-weight: bold; border-bottom: 1px solid #e5e7eb; }
        .horario-linha { border-bottom: 1px solid #f0f0f0; }
        .horario-linha:last-child { border-bottom: 0; }
        .horario-linha strong { font-size: 14px; }
        .horario-linha input[type="time"] { width: 100%; min-width: 0; }
        .horario-linha input[type="checkbox"] { width: 18px; height: 18px; cursor: pointer; }

        .category-list { display: grid; grid-template-columns: repeat(3, 1fr); gap: 15px; }
        .category { border: 1px solid #e5e7eb; border-radius: 10px; padding: 20px; text-align: center; background: #ffffff; }
        .category strong { display: block; margin-bottom: 5px; font-size: 15px; }

        .store-logo-box { border: 1px dashed #d1d5db; border-radius: 12px; padding: 16px; background: #f9fafb; }
        .store-logo-row { display: flex; align-items: center; gap: 18px; flex-wrap: wrap; }
        .store-logo-preview { width: 100px; height: 100px; border-radius: 16px; object-fit: contain; background: white; border: 1px solid #e5e7eb; display: none; padding: 8px; }

        .image-preview-modal { width: 90px; height: 90px; border-radius: 10px; object-fit: cover; border: 1px solid #d1d5db; background: #f3f4f6; margin-top: 8px; display: none; }

        .notice { padding: 15px; border-radius: 10px; background: #fffbeb; border: 1px solid #fde68a; color: #92400e; font-size: 14px; margin-bottom: 20px; }

        .modal-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,.55); z-index: 1000; padding: 20px; align-items: center; justify-content: center; }
        .modal-overlay.active { display: flex; }
        .modal { width: 100%; max-width: 650px; max-height: 90vh; overflow-y: auto; background: white; border-radius: 16px; padding: 25px; box-shadow: 0 20px 50px rgba(0,0,0,.2); }
        .modal-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .modal-header h3 { font-size: 20px; }
        .close-modal { width: 35px; height: 35px; border: 0; border-radius: 50%; background: #f3f4f6; cursor: pointer; font-size: 18px; line-height: 1; }

        .settings-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 16px; }
        .setting-card { border: 1px solid #e5e7eb; border-radius: 12px; padding: 18px; display: grid; grid-template-columns: auto 1fr; gap: 12px 14px; align-items: start; background: #fff; }
        .setting-card h4 { font-size: 16px; margin-bottom: 5px; }
        .setting-card p { color: #6b7280; font-size: 13px; line-height: 1.5; }
        .setting-icon { width: 42px; height: 42px; border-radius: 10px; background: #f3f4f6; display: flex; align-items: center; justify-content: center; font-size: 20px; }
        .setting-danger { border-color: #fecaca; background: #fffafa; }

        .color-control { display: grid; grid-template-columns: 56px 1fr; gap: 10px; align-items: center; }
        .color-control input[type="color"] { width: 56px; height: 42px; padding: 3px; border: 1px solid #d1d5db; border-radius: 9px; background: #fff; cursor: pointer; }

        .phone-input-group { display: flex; align-items: center; }
        .phone-prefix { background: #e5e7eb; border: 1px solid #d1d5db; border-right: none; padding: 11px 14px; border-radius: 8px 0 0 8px; font-weight: bold; color: #374151; }
        .phone-input-group input { border-radius: 0 8px 8px 0 !important; }

        @media (max-width: 900px) {
            .sidebar { width: 210px; }
            .content { margin-left: 210px; width: calc(100% - 210px); }
            .stats, .category-list, .settings-grid { grid-template-columns: 1fr; }
        }
        @media (max-width: 650px) {
            .sidebar { position: relative; width: 100%; height: auto; }
            .app { display: block; }
            .content { margin-left: 0; width: 100%; padding: 15px; }
            .form-grid { grid-template-columns: 1fr; }
            .product { flex-direction: column; align-items: flex-start; }
            .product-actions { width: 100%; justify-content: flex-start; }
            .products-toolbar { flex-direction: column; align-items: stretch; }
        }
    </style>
</head>

<body>

<div class="app">

    <aside class="sidebar">
        <div>
            <div class="brand">
                <h1>Lauanne Connect</h1>
                <p>Painel Administrativo</p>
            </div>

            <nav class="menu">
                <button class="menu-btn active" data-section="dashboard">
                    <svg class="menu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
                    Dashboard
                </button>

                <button class="menu-btn" data-section="loja">
                    <svg class="menu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 10l2-6h14l2 6"/><path d="M5 10v10h14V10"/><path d="M9 20v-6h6v6"/></svg>
                    Minha Loja
                </button>

                <button class="menu-btn" data-section="produtos">
                    <svg class="menu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="8"/><path d="M8 12h8"/><path d="M12 8v8"/></svg>
                    Produtos Online
                </button>

                <button class="menu-btn" data-section="categorias">
                    <svg class="menu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h6v6H4z"/><path d="M14 4h6v6h-6z"/><path d="M4 14h6v6H4z"/><path d="M14 14h6v6h-6z"/></svg>
                    Categorias
                </button>

                <button class="menu-btn" data-section="cardapioLoja">
                    <svg class="menu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 3h18v4H3z"/><path d="M5 7v13a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V7"/><path d="M10 11h4"/></svg>
                    Cardápio Loja Física
                </button>

                <button class="menu-btn" data-section="cardapioImpresso">
                    <svg class="menu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
                    Cardápio Impresso / PDF
                </button>

                <button class="menu-btn" data-section="whatsapp">
                    <svg class="menu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
                    WhatsApp Hub
                </button>

                <button class="menu-btn" data-section="redes">
                    <svg class="menu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="4" y="4" width="16" height="16" rx="4"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1"/></svg>
                    Redes Sociais
                </button>

                <button class="menu-btn" data-section="aparencia">
                    <svg class="menu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"/><path d="M8 12h8"/><path d="M12 8v8"/></svg>
                    Aparência Online
                </button>

                <button class="menu-btn" data-section="configuracoes">
                    <svg class="menu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.7 1.7 0 0 0 .3 1.9l.1.1-1.8 1.8-.1-.1a1.7 1.7 0 0 0-1.9-.3 1.7 1.7 0 0 0-1 1.6V20h-2.6v-.1a1.7 1.7 0 0 0-1-1.6 1.7 1.7 0 0 0-1.9.3l-.1.1-1.8-1.8.1-.1A1.7 1.7 0 0 0 8 15a1.7 1.7 0 0 0-1.6-1H6v-2.6h.4A1.7 1.7 0 0 0 8 10.3a1.7 1.7 0 0 0-.3-1.9l-.1-.1 1.8-1.8.1.1a1.7 1.7 0 0 0 1.9.3 1.7 1.7 0 0 0 1-1.6V5h2.6v.3a1.7 1.7 0 0 0 1 1.6 1.7 1.7 0 0 0 1.9-.3l.1-.1 1.8 1.8-.1.1a1.7 1.7 0 0 0-.3 1.9 1.7 1.7 0 0 0 1.6 1h.4V14h-.4a1.7 1.7 0 0 0-1.6 1Z"/></svg>
                    Configurações
                </button>
            </nav>
        </div>

        <div class="sidebar-bottom">
            <a href="logout.php" class="btn-logout">
                <svg class="menu-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                Sair do Painel
            </a>
            <div class="sidebar-footer">Lauanne Connect &copy; 2026</div>
        </div>
    </aside>

    <main class="content">
        <div class="topbar">
            <div><h2 id="pageTitle">Dashboard</h2></div>
            <div class="status"><span class="status-dot"></span> Sistema Conectado</div>
        </div>

        <!-- DASHBOARD -->
        <section id="dashboard" class="section active">
            <div class="stats">
                <div class="stat"><span>Produtos Online</span><strong id="totalProdutos">0</strong></div>
                <div class="stat"><span>Itens Loja Física</span><strong id="totalProdutosLoja">0</strong></div>
                <div class="stat"><span>Produtos Ativos</span><strong id="produtosAtivos">0</strong></div>
                <div class="stat"><span>Destaques</span><strong id="totalDestaques">0</strong></div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3>Bem-vindo ao Lauanne Connect</h3>
                    <p>Centro operacional da sua loja física e digital.</p>
                </div>
                <div class="notice">
                    ⚡ Gerencie produtos, horários e links do seu negócio. As alterações refletem diretamente nos cardápios.
                </div>
                <div style="display:flex; gap:12px; flex-wrap:wrap; margin-top:10px;">
                    <a href="cardapioweb.php" target="_blank" class="btn btn-primary">Abrir Cardápio Delivery</a>
                    <a href="cardapioloja.php" target="_blank" class="btn btn-secondary">Abrir Cardápio da Loja</a>
                </div>
            </div>
        </section>

        <!-- MINHA LOJA -->
        <section id="loja" class="section">
            <div class="card">
                <div class="card-header">
                    <h3>Minha Loja</h3>
                    <p>Cadastre as informações que identificam seu estabelecimento.</p>
                </div>

                <div class="field full" style="margin-bottom:20px;">
                    <label>Logo da loja</label>
                    <div class="store-logo-box">
                        <div class="store-logo-row">
                            <img id="lojaLogoPreview" class="store-logo-preview" alt="Prévia Logo">
                            <div class="store-logo-info">
                                <input id="lojaLogoArquivo" type="file" accept="image/*" onchange="processarUploadLogo(this)">
                                <small style="display:block;margin-top:4px;color:#6b7280;">Escolha a imagem da logo para salvar localmente.</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-grid">
                    <div class="field full">
                        <label>Nome da loja</label>
                        <input id="lojaNome" type="text" placeholder="Nome do negócio">
                    </div>
                    <div class="field">
                        <label>Telefone fixo</label>
                        <input id="lojaTelefone" type="text" placeholder="(00) 0000-0000">
                    </div>
                    <div class="field">
                        <label>WhatsApp Comercial</label>
                        <div class="phone-input-group">
                            <span class="phone-prefix">+55</span>
                            <input id="lojaWhatsapp" type="text" placeholder="21999999999">
                        </div>
                    </div>
                    <div class="field full">
                        <label>Endereço completo</label>
                        <input id="lojaEndereco" type="text" placeholder="Rua, número e complemento">
                    </div>
                    <div class="field">
                        <label>Bairro</label>
                        <input id="lojaBairro" type="text" placeholder="Bairro">
                    </div>
                    <div class="field">
                        <label>Cidade</label>
                        <input id="lojaCidade" type="text" placeholder="Cidade">
                    </div>
                    <div class="field">
                        <label>Estado (UF)</label>
                        <input id="lojaEstado" type="text" maxlength="2" placeholder="RJ">
                    </div>
                    <div class="field">
                        <label>CEP</label>
                        <input id="lojaCep" type="text" placeholder="00000-000">
                    </div>

                    <div class="field full">
                        <label>Horário de funcionamento semanal</label>
                        <div class="horarios-semana">
                            <div class="horario-cabecalho"><span>Dia</span><span>Aberto</span><span>Abre</span><span>Fecha</span></div>
                            <div class="horario-linha"><strong>Segunda-feira</strong><input type="checkbox" id="diaSegunda" checked><input type="time" id="abreSegunda" value="13:00"><input type="time" id="fechaSegunda" value="21:00"></div>
                            <div class="horario-linha"><strong>Terça-feira</strong><input type="checkbox" id="diaTerca" checked><input type="time" id="abreTerca" value="13:00"><input type="time" id="fechaTerca" value="21:00"></div>
                            <div class="horario-linha"><strong>Quarta-feira</strong><input type="checkbox" id="diaQuarta" checked><input type="time" id="abreQuarta" value="13:00"><input type="time" id="fechaQuarta" value="21:00"></div>
                            <div class="horario-linha"><strong>Quinta-feira</strong><input type="checkbox" id="diaQuinta" checked><input type="time" id="abreQuinta" value="13:00"><input type="time" id="fechaQuinta" value="21:00"></div>
                            <div class="horario-linha"><strong>Sexta-feira</strong><input type="checkbox" id="diaSexta" checked><input type="time" id="abreSexta" value="13:00"><input type="time" id="fechaSexta" value="21:00"></div>
                            <div class="horario-linha"><strong>Sábado</strong><input type="checkbox" id="diaSabado" checked><input type="time" id="abreSabado" value="13:00"><input type="time" id="fechaSabado" value="21:00"></div>
                            <div class="horario-linha"><strong>Domingo</strong><input type="checkbox" id="diaDomingo" checked><input type="time" id="abreDomingo" value="13:00"><input type="time" id="fechaDomingo" value="21:00"></div>
                        </div>
                    </div>

                    <div class="field full">
                        <label>Descrição do estabelecimento</label>
                        <textarea id="lojaDescricao"></textarea>
                    </div>
                </div>

                <div class="actions">
                    <button class="btn btn-primary" onclick="salvarLoja()">Salvar dados da loja</button>
                    <button class="btn btn-secondary" onclick="carregarDadosLoja()">Desfazer alterações</button>
                </div>
            </div>
        </section>

        <!-- PRODUTOS ONLINE -->
        <section id="produtos" class="section">
            <div class="card">
                <div class="card-header">
                    <h3>Produtos do Cardápio Online (Delivery)</h3>
                    <p>Cadastre fotos, preços e categorias dos itens de delivery. Use ⬆ / ⬇ para ordenar.</p>
                </div>
                <div class="products-toolbar">
                    <div class="search-box"><input id="buscaProduto" type="text" placeholder="🔍 Buscar produto..." oninput="renderizarProdutos()"></div>
                    <button class="btn btn-primary" onclick="abrirNovoProduto()">+ Novo produto</button>
                </div>
                <div id="listaProdutos" class="product-list"></div>
            </div>
        </section>

        <!-- CATEGORIAS -->
        <section id="categorias" class="section">
            <div class="card">
                <div class="card-header">
                    <h3>Categorias</h3>
                    <p>Categorias ativas geradas pelos produtos cadastrados (Primeira letra maiúscula automática).</p>
                </div>
                <div id="listaCategorias" class="category-list"></div>
            </div>
        </section>

        <!-- CARDÁPIO LOJA FÍSICA -->
        <section id="cardapioLoja" class="section">
            <div class="card">
                <div class="card-header">
                    <h3>Configuração do Cardápio da Loja Física</h3>
                    <p>Defina o layout, número da cozinha e acesse o link de mesa.</p>
                </div>

                <div class="field full" style="margin-bottom: 22px; background: #faf5ff; padding: 18px; border-radius: 12px; border: 1.5px solid #d8b4fe;">
                    <label style="color: #6b21a8; font-size: 14px;">🎨 Modelo de Layout EXCLUSIVO da Loja Física</label>
                    <div style="display: flex; gap: 10px; flex-wrap: wrap; align-items: center; margin-top: 10px;">
                        <select id="selectModeloLayoutLoja" style="border-color: #a855f7; font-weight: bold; flex: 1; min-width: 260px;">
                            <option value="hub_classico">🔗 Hub Clássico (Fazer Pedido, Insta, Wi-Fi e Horários)</option>
                            <option value="vitrine_abas">📑 Vitrine com Abas (Cardápio & Informações da Loja)</option>
                            <option value="app_delivery">📱 App Delivery (Formato Aplicativo com compra rápida no balcão)</option>
                        </select>
                        <button class="btn btn-primary" onclick="salvarModeloLayoutLojaManual()">Salvar Modelo da Loja</button>
                    </div>
                </div>

                <div class="settings-grid">
                    <div class="setting-card" style="grid-column: 1 / -1;">
                        <div class="setting-icon">🛎️</div>
                        <div style="width: 100%;">
                            <h4>WhatsApp do Balcão / Cozinha</h4>
                            <p>Número que receberá as mensagens diretas de pedidos da mesa/balcão.</p>
                            <div class="field" style="margin-top: 10px; max-width: 350px;">
                                <div class="phone-input-group">
                                    <span class="phone-prefix">+55</span>
                                    <input type="text" id="whatsCozinhaInput" placeholder="21977138992">
                                </div>
                            </div>
                            <button class="btn btn-primary" style="margin-top: 10px;" onclick="salvarWhatsCozinha()">Salvar Telefone da Cozinha</button>
                        </div>
                    </div>

                    <div class="setting-card">
                        <div class="setting-icon">📱</div>
                        <div>
                            <h4>QR Code de Mesa / Balcão</h4>
                            <p>Acesse ou copie o link direto para o cardápio da loja física (<code>cardapioloja.php</code>).</p>
                            <div style="margin: 15px 0;">
                                <img id="qrCodeLojaPreview" src="" alt="QR Code Loja" style="width: 150px; height: 150px; border: 1px solid #e5e7eb; border-radius: 10px;">
                            </div>
                            <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                                <button class="btn btn-primary" onclick="copiarLinkLojaFisica()">Copiar Link</button>
                                <button class="btn btn-secondary" onclick="abrirCardapioLojaFisica()">Abrir Cardápio</button>
                            </div>
                        </div>
                    </div>

                    <div class="setting-card">
                        <div class="setting-icon">💡</div>
                        <div>
                            <h4>Regras de Balcão Ativas</h4>
                            <p>• <strong>Sem endereço:</strong> Apenas identificação da mesa/nome.<br>
                               • <strong>PIX:</strong> Chave rápida com verificação no balcão.<br>
                               • <strong>Dinheiro/Cartão:</strong> Cliente finaliza diretamente no caixa.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3>Produtos & Combos Exclusivos da Loja Física</h3>
                    <p>Cadastre ofertas de balcão e combos. A cópia agora SOMA aos produtos existentes sem apagar nada.</p>
                </div>
                <div class="products-toolbar">
                    <button class="btn btn-primary" onclick="abrirNovoProdutoLoja()">+ Adicionar Produto ou Promoção da Loja</button>
                    <button class="btn btn-secondary" onclick="importarProdutosParaLoja()">Copiar produtos do delivery para cá (Somar)</button>
                </div>
                <div id="listaProdutosLoja" class="product-list"></div>
            </div>
        </section>

        <!-- CARDÁPIO IMPRESSO / PDF -->
        <section id="cardapioImpresso" class="section">
            <div class="card">
                <div class="card-header">
                    <h3>Configuração e Impressão do Cardápio Físico & PDF</h3>
                    <p>Selecione as cores da folha e abra o gerador para imprimir ou salvar como PDF.</p>
                </div>
                <div class="form-grid">
                    <div class="field full">
                        <label>Modelo do Cardápio Impresso</label>
                        <select id="selectModeloImpresso">
                            <option value="modelo2">Modelo 2 - Faixas & Colunas</option>
                            <option value="modelo1">Modelo 1 - Flyer Visual em Grade</option>
                        </select>
                    </div>
                    <div class="field">
                        <label>Cor Principal das Faixas / Títulos</label>
                        <div class="color-control">
                            <input id="corImpressoPrimaria" type="color" value="#f4b800">
                            <input id="corImpressoPrimariaHex" type="text" value="#f4b800" maxlength="7">
                        </div>
                    </div>
                    <div class="field">
                        <label>Cor do Texto das Faixas</label>
                        <div class="color-control">
                            <input id="corImpressoSecundaria" type="color" value="#222222">
                            <input id="corImpressoSecundariaHex" type="text" value="#222222" maxlength="7">
                        </div>
                    </div>
                    <div class="field">
                        <label>Cor de Fundo da Folha A4</label>
                        <div class="color-control">
                            <input id="corImpressoFundo" type="color" value="#ffffff">
                            <input id="corImpressoFundoHex" type="text" value="#ffffff" maxlength="7">
                        </div>
                    </div>
                    <div class="field">
                        <label>Mensagem / Aviso de Rodapé</label>
                        <input id="avisoImpresso" type="text" value="ACEITAMOS CARTÕES E PIX">
                    </div>
                </div>
                <div class="actions">
                    <button class="btn btn-primary" onclick="salvarConfigImpresso()">Salvar Configurações</button>
                    <button class="btn btn-secondary" onclick="imprimirDiretoPainel()">🖨️ Imprimir / Salvar PDF</button>
                </div>
            </div>
        </section>

        <!-- WHATSAPP HUB & LISTA DE TRANSMISSÃO -->
        <section id="whatsapp" class="section">
            <div class="card">
                <div class="card-header">
                    <h3>Central WhatsApp & Marketing</h3>
                    <p>Compartilhe o cardápio e envie mensagens promocionais para suas listas de transmissão.</p>
                </div>
                <div class="settings-grid" style="margin-bottom: 25px;">
                    <div class="setting-card">
                        <div class="setting-icon">📱</div>
                        <div><h4>Link Direto do Cardápio</h4><p>Compartilhe o cardápio com uma mensagem padrão.</p></div>
                        <div style="grid-column: 2; display: flex; gap: 8px;">
                            <button class="btn btn-whatsapp" onclick="dispararLinkWhatsApp()">Enviar no WhatsApp</button>
                            <button class="btn btn-secondary" onclick="copiarMensagemWhatsApp()">Copiar</button>
                        </div>
                    </div>
                </div>

                <div class="card-header" style="border-top: 1px solid #e5e7eb; padding-top: 20px;">
                    <h3>📢 Promoções da Semana (Lista de Transmissão)</h3>
                    <p>Crie um texto com ofertas e envie direto para o WhatsApp para disparar aos seus contatos.</p>
                </div>

                <div class="form-grid">
                    <div class="field full">
                        <label>Título da Campanha</label>
                        <input id="promoTitulo" type="text" value="🔥 PROMOÇÃO DA SEMANA - NÃO PERCA!">
                    </div>
                    <div class="field full">
                        <label>Texto da Promoção / Ofertas</label>
                        <textarea id="promoCorpo" style="min-height: 120px;">🍨 Na compra de 2 Açais de 500ml, ganhe 1 cobertura especial grátis!
⚡ Válido até durarem os estoques. Peça agora pelo link abaixo:</textarea>
                    </div>
                </div>

                <div class="actions">
                    <button class="btn btn-whatsapp" onclick="dispararPromocaoWhatsApp()">🚀 Enviar para WhatsApp / Lista</button>
                    <button class="btn btn-secondary" onclick="copiarPromocaoWhatsApp()">📋 Copiar Texto Completo</button>
                </div>
            </div>
        </section>

        <!-- REDES SOCIAIS -->
        <section id="redes" class="section">
            <div class="card">
                <div class="card-header"><h3>Redes Sociais</h3><p>Configure os links externos e canais da sua loja.</p></div>
                <div class="form-grid">
                    <div class="field"><label>Instagram</label><input id="instagram" type="text" placeholder="@sualoja"></div>
                    <div class="field"><label>Facebook</label><input id="facebook" type="text" placeholder="facebook.com/sualoja"></div>
                    <div class="field"><label>TikTok</label><input id="tiktok" type="text" placeholder="@sualoja"></div>
                    <div class="field">
                        <label>WhatsApp de Pedidos</label>
                        <div class="phone-input-group">
                            <span class="phone-prefix">+55</span>
                            <input id="whatsappRede" type="text" placeholder="21999999999">
                        </div>
                    </div>
                    <div class="field"><label>Link Google Avaliações</label><input id="googleAvaliacoes" type="text" placeholder="https://g.page/r/..."></div>
                </div>
                <div class="actions"><button class="btn btn-primary" onclick="salvarRedes()">Salvar redes sociais</button></div>
            </div>
        </section>

        <!-- APARÊNCIA ONLINE -->
        <section id="aparencia" class="section">
            <div class="card">
                <div class="card-header">
                    <h3>Aparência do Cardápio Online (Delivery)</h3>
                    <p>Personalize as cores e o layout exibido em <code>cardapioweb.php</code>.</p>
                </div>

                <div class="field full" style="margin-bottom: 20px;">
                    <label>Modelo de Layout do Cardápio Online (Delivery)</label>
                    <select id="selectModeloLayout">
                        <option value="hub_classico">🔗 Hub Clássico (Estilo Linktree)</option>
                        <option value="vitrine_abas">📑 Vitrine com Abas (Cardápio & Informações)</option>
                        <option value="app_delivery">📱 App Delivery (Formato Aplicativo)</option>
                    </select>
                </div>

                <div class="form-grid">
                    <div class="field">
                        <label>Cor principal</label>
                        <div class="color-control">
                            <input id="aparenciaCorPrincipal" type="color" value="#FFD400">
                            <input id="aparenciaCorPrincipalHex" type="text" value="#FFD400" maxlength="7">
                        </div>
                    </div>
                    <div class="field">
                        <label>Cor secundária</label>
                        <div class="color-control">
                            <input id="aparenciaCorSecundaria" type="color" value="#7B2CBF">
                            <input id="aparenciaCorSecundariaHex" type="text" value="#7B2CBF" maxlength="7">
                        </div>
                    </div>
                </div>
                <div class="actions" style="margin-top: 20px;">
                    <button class="btn btn-primary" type="button" onclick="salvarAparenciaOnlineManual()">Salvar Aparência Online</button>
                </div>
            </div>
        </section>

        <!-- CONFIGURAÇÕES -->
        <section id="configuracoes" class="section">
            <div class="card">
                <div class="card-header"><h3>Configurações & Dados</h3><p>Backup ou limpeza dos registros locais.</p></div>
                <div class="settings-grid">
                    <div class="setting-card">
                        <div class="setting-icon">💾</div>
                        <div><h4>Baixar Backup Completo</h4><p>Exporta produtos e personalizações em JSON.</p></div>
                        <button class="btn btn-primary" style="grid-column:2;" onclick="exportarDados()">Baixar backup</button>
                    </div>
                    <div class="setting-card setting-danger">
                        <div class="setting-icon">⚠️</div>
                        <div><h4>Apagar Dados Locais</h4><p>Restaura as configurações locais.</p></div>
                        <button class="btn btn-danger" style="grid-column:2;" onclick="limparDados()">Apagar tudo</button>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>

<!-- MODAL DE PRODUTO -->
<div id="modalProduto" class="modal-overlay">
    <div class="modal">
        <div class="modal-header">
            <h3 id="modalTitulo">Editar produto</h3>
            <button class="close-modal" onclick="fecharModal()">&times;</button>
        </div>
        <div class="form-grid">
            <div class="field full">
                <label>Foto do Produto</label>
                <input id="produtoFotoArquivo" type="file" accept="image/*" onchange="processarUploadFotoProduto(this)">
                <img id="previewFotoProduto" class="image-preview-modal" alt="Prévia">
            </div>
            <div class="field full"><label>Nome</label><input id="produtoNome" type="text" placeholder="Nome do item"></div>
            <div class="field"><label>Categoria</label><input id="produtoCategoria" type="text" placeholder="Ex: Bebidas, Sobremesas"></div>
            <div class="field"><label>Preço (R$)</label><input id="produtoPreco" type="number" step="0.01" placeholder="0,00"></div>
            <div class="field full"><label>Descrição</label><textarea id="produtoDescricao" placeholder="Ingredientes e detalhes"></textarea></div>
            <div class="field"><label>Disponibilidade</label><select id="produtoDisponivel"><option value="true">Disponível</option><option value="false">Indisponível</option></select></div>
            <div class="field"><label>Destaque?</label><select id="produtoDestaque"><option value="false">Não</option><option value="true">Sim</option></select></div>
        </div>
        <div class="actions">
            <button class="btn btn-primary" onclick="salvarProdutoGenerico()">Salvar</button>
            <button class="btn btn-secondary" onclick="fecharModal()">Cancelar</button>
        </div>
    </div>
</div>

<script>
    const PRODUTOS_PADRAO = [
        { id: "p1", nome: "COMBO SOFRÊNCIA", categoria: "Combos", preco: 15.00, descricao: "250g batata frita + 250g mini salgados + calabresa", disponivel: true, destaque: true, imagem: "" },
        { id: "p2", nome: "COMBO PEGAÇÃO", categoria: "Combos", preco: 27.00, descricao: "250g batata frita + mini salgados + calabresa", disponivel: true, destaque: true, imagem: "" }
    ];

    let produtosPainel = JSON.parse(localStorage.getItem("hubProdutos")) || PRODUTOS_PADRAO;
    let produtosLojaFisica = JSON.parse(localStorage.getItem("hubProdutosLoja")) || [
        { id: "pl1", nome: "COMBO DO DIA (BALCÃO)", categoria: "Promoções", preco: 19.90, descricao: "Sorvete artesanal duplo + cascata extra", disponivel: true, destaque: true, imagem: "" }
    ];

    let produtoEditando = null;
    let contextoEdicao = "online";
    let imagemBase64Temp = "";

    const botoesMenu = document.querySelectorAll(".menu-btn");
    const secoes = document.querySelectorAll(".section");
    const tituloPagina = document.getElementById("pageTitle");

    botoesMenu.forEach(btn => {
        btn.addEventListener("click", () => {
            botoesMenu.forEach(b => b.classList.remove("active"));
            btn.classList.add("active");
            secoes.forEach(s => s.classList.remove("active"));
            const targetId = btn.dataset.section;
            document.getElementById(targetId).classList.add("active");
            tituloPagina.textContent = btn.textContent.trim();

            if (targetId === "produtos") renderizarProdutos();
            if (targetId === "cardapioLoja") carregarModuloCardapioLoja();
            if (targetId === "categorias") renderizarCategorias();
            if (targetId === "dashboard") atualizarDashboard();
            if (targetId === "aparencia") carregarAparencia();
            if (targetId === "cardapioImpresso") carregarConfigImpresso();
        });
    });

    function formatarPreco(val) { return Number(val || 0).toFixed(2).replace(".", ","); }

    /* CAPITALIZAR PRIMEIRA LETRA DAS CATEGORIAS */
    function formatarCategoria(texto) {
        if (!texto) return "";
        return texto.trim().split(/\s+/).map(palavra => {
            return palavra.charAt(0).toUpperCase() + palavra.slice(1).toLowerCase();
        }).join(" ");
    }

    /* REORDENAÇÃO DE PRODUTOS */
    function moverProduto(index, direcao, tipo) {
        const arr = tipo === "loja" ? produtosLojaFisica : produtosPainel;
        const novoIndex = index + direcao;

        if (novoIndex < 0 || novoIndex >= arr.length) return;

        const item = arr.splice(index, 1)[0];
        arr.splice(novoIndex, 0, item);

        if (tipo === "loja") {
            localStorage.setItem("hubProdutosLoja", JSON.stringify(arr));
            renderizarProdutosLojaFisica();
        } else {
            localStorage.setItem("hubProdutos", JSON.stringify(arr));
            renderizarProdutos();
        }
    }

    /* UPLOAD DE FOTOS (BASE64) */
    function processarUploadFotoProduto(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagemBase64Temp = e.target.result;
                const prev = document.getElementById("previewFotoProduto");
                prev.src = imagemBase64Temp;
                prev.style.display = "block";
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function processarUploadLogo(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const imgData = e.target.result;
                const preview = document.getElementById("lojaLogoPreview");
                preview.src = imgData;
                preview.style.display = "block";
                
                const loja = JSON.parse(localStorage.getItem("hubLoja") || "{}");
                loja.logo = imgData;
                localStorage.setItem("hubLoja", JSON.stringify(loja));
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    /* CARDÁPIO LOJA FÍSICA */
    function carregarModuloCardapioLoja() {
        let whats = localStorage.getItem("hubTelefoneCozinha") || "21977138992";
        if (whats.startsWith("55") && whats.length > 10) whats = whats.substring(2);
        document.getElementById("whatsCozinhaInput").value = whats;

        const modeloLoja = localStorage.getItem("hubModeloLoja") || "hub_classico";
        document.getElementById("selectModeloLayoutLoja").value = modeloLoja;

        gerarQrCodeLojaFisica();
        renderizarProdutosLojaFisica();
    }

    function salvarModeloLayoutLojaManual() {
        const modelo = document.getElementById("selectModeloLayoutLoja").value;
        localStorage.setItem("hubModeloLoja", modelo);
        alert("Modelo da Loja Física salvo!");
    }

    function salvarWhatsCozinha() {
        let val = document.getElementById("whatsCozinhaInput").value.trim().replace(/\D/g, '');
        if (!val) { alert("Digite um telefone válido."); return; }
        if (!val.startsWith("55")) val = "55" + val;
        localStorage.setItem("hubTelefoneCozinha", val);
        alert("Telefone da Cozinha salvo com sucesso!");
    }

    function obterUrlLojaFisica() {
        let base = window.location.href.substring(0, window.location.href.lastIndexOf('/') + 1);
        return base + "cardapioloja.php";
    }

    function gerarQrCodeLojaFisica() {
        const url = obterUrlLojaFisica();
        document.getElementById("qrCodeLojaPreview").src = `https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=${encodeURIComponent(url)}`;
    }

    function copiarLinkLojaFisica() {
        navigator.clipboard.writeText(obterUrlLojaFisica()).then(() => alert("Link copiado!"));
    }

    function abrirCardapioLojaFisica() {
        window.open('cardapioloja.php', '_blank');
    }

    function renderizarProdutosLojaFisica() {
        const lista = document.getElementById("listaProdutosLoja");
        lista.innerHTML = "";
        produtosLojaFisica.forEach((p, index) => {
            const item = document.createElement("div");
            item.className = "product";
            const fotoTag = p.imagem 
                ? `<img src="${p.imagem}" class="product-image" alt="${p.nome}">`
                : `<div class="product-image" style="display:grid;place-items:center;font-size:24px;">🏷️</div>`;

            item.innerHTML = `
                <div class="product-info">
                    ${fotoTag}
                    <div>
                        <h4>${p.nome}</h4>
                        <p>${formatarCategoria(p.categoria)} • ${p.descricao || ""}</p>
                        <div class="product-price">R$ ${formatarPreco(p.preco)}</div>
                    </div>
                </div>
                <div class="product-actions">
                    <button class="btn btn-secondary btn-sm" onclick="moverProduto(${index}, -1, 'loja')" ${index === 0 ? 'disabled style="opacity:0.4;"' : ''} title="Subir posição">⬆</button>
                    <button class="btn btn-secondary btn-sm" onclick="moverProduto(${index}, 1, 'loja')" ${index === produtosLojaFisica.length - 1 ? 'disabled style="opacity:0.4;"' : ''} title="Descer posição">⬇</button>
                    <button class="btn btn-secondary btn-sm" onclick="editarProduto(${index}, 'loja')">Editar</button>
                    <button class="btn btn-danger btn-sm" onclick="excluirProduto(${index}, 'loja')">Excluir</button>
                </div>
            `;
            lista.appendChild(item);
        });
    }

    /* IMPORTAR SOMANDO SEM APAGAR OS DA LOJA */
    function importarProdutosParaLoja() {
        if (confirm("Deseja importar e somar os produtos do Delivery para a Loja Física sem apagar os existentes?")) {
            const nomesExistentes = new Set(produtosLojaFisica.map(p => p.nome.trim().toLowerCase()));
            let novosAdicionados = 0;

            produtosPainel.forEach(prod => {
                if (!nomesExistentes.has(prod.nome.trim().toLowerCase())) {
                    produtosLojaFisica.push({
                        ...JSON.parse(JSON.stringify(prod)),
                        id: "pl-" + Date.now() + "-" + Math.floor(Math.random() * 1000)
                    });
                    novosAdicionados++;
                }
            });

            localStorage.setItem("hubProdutosLoja", JSON.stringify(produtosLojaFisica));
            renderizarProdutosLojaFisica();
            atualizarDashboard();
            alert(`${novosAdicionados} novo(s) produto(s) somado(s) à Loja Física! Os itens existentes foram preservados.`);
        }
    }

    /* GESTÃO DE PRODUTOS ONLINE */
    function renderizarProdutos() {
        const lista = document.getElementById("listaProdutos");
        lista.innerHTML = "";
        const busca = document.getElementById("buscaProduto").value.toLowerCase().trim();

        const filtradosComIndice = produtosPainel.map((p, originalIndex) => ({ produto: p, originalIndex }))
                                                .filter(item => (item.produto.nome + " " + (item.produto.categoria || "")).toLowerCase().includes(busca));

        filtradosComIndice.forEach(({ produto: p, originalIndex }) => {
            const item = document.createElement("div");
            item.className = "product";
            const fotoTag = p.imagem 
                ? `<img src="${p.imagem}" class="product-image" alt="${p.nome}">`
                : `<div class="product-image" style="display:grid;place-items:center;font-size:24px;">🍽️</div>`;

            item.innerHTML = `
                <div class="product-info">
                    ${fotoTag}
                    <div>
                        <h4>${p.nome}</h4>
                        <p>${formatarCategoria(p.categoria)} • ${p.descricao || ""}</p>
                        <div class="product-price">R$ ${formatarPreco(p.preco)}</div>
                    </div>
                </div>
                <div class="product-actions">
                    <button class="btn btn-secondary btn-sm" onclick="moverProduto(${originalIndex}, -1, 'online')" ${originalIndex === 0 ? 'disabled style="opacity:0.4;"' : ''} title="Subir posição">⬆</button>
                    <button class="btn btn-secondary btn-sm" onclick="moverProduto(${originalIndex}, 1, 'online')" ${originalIndex === produtosPainel.length - 1 ? 'disabled style="opacity:0.4;"' : ''} title="Descer posição">⬇</button>
                    <button class="btn btn-secondary btn-sm" onclick="editarProduto(${originalIndex}, 'online')">Editar</button>
                    <button class="btn btn-danger btn-sm" onclick="excluirProduto(${originalIndex}, 'online')">Excluir</button>
                </div>
            `;
            lista.appendChild(item);
        });
    }

    function abrirNovoProduto() { contextoEdicao = "online"; abrirModal("Novo Produto Online"); }
    function abrirNovoProdutoLoja() { contextoEdicao = "loja"; abrirModal("Novo Item da Loja Física"); }

    function abrirModal(titulo) {
        produtoEditando = null;
        imagemBase64Temp = "";
        document.getElementById("modalTitulo").textContent = titulo;
        document.getElementById("produtoNome").value = "";
        document.getElementById("produtoCategoria").value = "";
        document.getElementById("produtoPreco").value = "";
        document.getElementById("produtoDescricao").value = "";
        document.getElementById("produtoFotoArquivo").value = "";
        const prev = document.getElementById("previewFotoProduto");
        prev.src = "";
        prev.style.display = "none";
        document.getElementById("modalProduto").classList.add("active");
    }

    function editarProduto(index, tipo) {
        contextoEdicao = tipo;
        produtoEditando = index;
        const arr = tipo === "loja" ? produtosLojaFisica : produtosPainel;
        const p = arr[index];

        document.getElementById("modalTitulo").textContent = "Editar Produto";
        document.getElementById("produtoNome").value = p.nome;
        document.getElementById("produtoCategoria").value = formatarCategoria(p.categoria);
        document.getElementById("produtoPreco").value = p.preco;
        document.getElementById("produtoDescricao").value = p.descricao || "";
        document.getElementById("produtoFotoArquivo").value = "";

        const prev = document.getElementById("previewFotoProduto");
        if (p.imagem) {
            imagemBase64Temp = p.imagem;
            prev.src = p.imagem;
            prev.style.display = "block";
        } else {
            imagemBase64Temp = "";
            prev.src = "";
            prev.style.display = "none";
        }

        document.getElementById("modalProduto").classList.add("active");
    }

    function salvarProdutoGenerico() {
        const nome = document.getElementById("produtoNome").value.trim();
        const categoria = formatarCategoria(document.getElementById("produtoCategoria").value);
        const preco = parseFloat(document.getElementById("produtoPreco").value);
        const descricao = document.getElementById("produtoDescricao").value.trim();
        const arr = contextoEdicao === "loja" ? produtosLojaFisica : produtosPainel;

        if (!nome || isNaN(preco)) { alert("Preencha o nome e um preço válido."); return; }

        const dadosItem = {
            id: produtoEditando === null ? "prod-" + Date.now() : arr[produtoEditando].id,
            nome,
            categoria,
            preco,
            descricao,
            disponivel: true,
            destaque: false,
            imagem: imagemBase64Temp
        };

        if (produtoEditando === null) {
            arr.push(dadosItem);
        } else {
            arr[produtoEditando] = dadosItem;
        }

        if (contextoEdicao === "loja") {
            localStorage.setItem("hubProdutosLoja", JSON.stringify(produtosLojaFisica));
            renderizarProdutosLojaFisica();
        } else {
            localStorage.setItem("hubProdutos", JSON.stringify(produtosPainel));
            renderizarProdutos();
        }

        fecharModal();
        atualizarDashboard();
        renderizarCategorias();
    }

    function excluirProduto(index, tipo) {
        const arr = tipo === "loja" ? produtosLojaFisica : produtosPainel;
        if (confirm("Excluir este item?")) {
            arr.splice(index, 1);
            if (tipo === "loja") localStorage.setItem("hubProdutosLoja", JSON.stringify(produtosLojaFisica));
            else localStorage.setItem("hubProdutos", JSON.stringify(produtosPainel));
            tipo === "loja" ? renderizarProdutosLojaFisica() : renderizarProdutos();
            atualizarDashboard();
            renderizarCategorias();
        }
    }

    function fecharModal() { document.getElementById("modalProduto").classList.remove("active"); }

    /* CARDÁPIO IMPRESSO */
    function carregarConfigImpresso() {
        const conf = JSON.parse(localStorage.getItem("hubImpressoConfig") || "{}");
        if (conf.modelo) document.getElementById("selectModeloImpresso").value = conf.modelo;
        if (conf.primaria) {
            document.getElementById("corImpressoPrimaria").value = conf.primaria;
            document.getElementById("corImpressoPrimariaHex").value = conf.primaria;
        }
        if (conf.secundaria) {
            document.getElementById("corImpressoSecundaria").value = conf.secundaria;
            document.getElementById("corImpressoSecundariaHex").value = conf.secundaria;
        }
        if (conf.fundo) {
            document.getElementById("corImpressoFundo").value = conf.fundo;
            document.getElementById("corImpressoFundoHex").value = conf.fundo;
        }
        if (conf.aviso) document.getElementById("avisoImpresso").value = conf.aviso;
    }

    function salvarConfigImpresso() {
        const conf = {
            modelo: document.getElementById("selectModeloImpresso").value,
            primaria: document.getElementById("corImpressoPrimariaHex").value,
            secundaria: document.getElementById("corImpressoSecundariaHex").value,
            fundo: document.getElementById("corImpressoFundoHex").value,
            aviso: document.getElementById("avisoImpresso").value.trim()
        };
        localStorage.setItem("hubImpressoConfig", JSON.stringify(conf));
        alert("Configurações do cardápio impresso salvas!");
    }

    function imprimirDiretoPainel() {
        salvarConfigImpresso();
        window.open('cardapioweb.php?print=true', '_blank');
    }

    /* DADOS DA LOJA */
    function salvarLoja() {
        const loja = JSON.parse(localStorage.getItem("hubLoja") || "{}");
        loja.nome = document.getElementById("lojaNome").value.trim();
        loja.telefone = document.getElementById("lojaTelefone").value.trim();
        
        let whats = document.getElementById("lojaWhatsapp").value.trim().replace(/\D/g, '');
        if (whats && !whats.startsWith("55")) whats = "55" + whats;
        loja.whatsapp = whats;

        loja.endereco = document.getElementById("lojaEndereco").value.trim();
        loja.bairro = document.getElementById("lojaBairro").value.trim();
        loja.cidade = document.getElementById("lojaCidade").value.trim();
        loja.estado = document.getElementById("lojaEstado").value.trim();
        loja.cep = document.getElementById("lojaCep").value.trim();
        loja.descricao = document.getElementById("lojaDescricao").value.trim();

        loja.horarios = {
            seg: { aberto: document.getElementById("diaSegunda").checked, abre: document.getElementById("abreSegunda").value, fecha: document.getElementById("fechaSegunda").value },
            ter: { aberto: document.getElementById("diaTerca").checked, abre: document.getElementById("abreTerca").value, fecha: document.getElementById("fechaTerca").value },
            qua: { aberto: document.getElementById("diaQuarta").checked, abre: document.getElementById("abreQuarta").value, fecha: document.getElementById("fechaQuarta").value },
            qui: { aberto: document.getElementById("diaQuinta").checked, abre: document.getElementById("abreQuinta").value, fecha: document.getElementById("fechaQuinta").value },
            sex: { aberto: document.getElementById("diaSexta").checked, abre: document.getElementById("abreSexta").value, fecha: document.getElementById("fechaSexta").value },
            sab: { aberto: document.getElementById("diaSabado").checked, abre: document.getElementById("abreSabado").value, fecha: document.getElementById("fechaSabado").value },
            dom: { aberto: document.getElementById("diaDomingo").checked, abre: document.getElementById("abreDomingo").value, fecha: document.getElementById("fechaDomingo").value }
        };

        localStorage.setItem("hubLoja", JSON.stringify(loja));
        alert("Dados da loja salvos!");
    }

    function carregarDadosLoja() {
        const salvo = JSON.parse(localStorage.getItem("hubLoja") || "{}");
        if (salvo.nome) document.getElementById("lojaNome").value = salvo.nome;
        document.getElementById("lojaTelefone").value = salvo.telefone || "";
        
        let whats = salvo.whatsapp || "";
        if (whats.startsWith("55") && whats.length > 10) whats = whats.substring(2);
        document.getElementById("lojaWhatsapp").value = whats;

        document.getElementById("lojaEndereco").value = salvo.endereco || "";
        document.getElementById("lojaBairro").value = salvo.bairro || "";
        document.getElementById("lojaCidade").value = salvo.cidade || "";
        document.getElementById("lojaEstado").value = salvo.estado || "";
        document.getElementById("lojaCep").value = salvo.cep || "";
        document.getElementById("lojaDescricao").value = salvo.descricao || "";

        if (salvo.logo) {
            const preview = document.getElementById("lojaLogoPreview");
            preview.src = salvo.logo;
            preview.style.display = "block";
        }

        if (salvo.horarios) {
            const h = salvo.horarios;
            if (h.seg) { document.getElementById("diaSegunda").checked = h.seg.aberto; document.getElementById("abreSegunda").value = h.seg.abre; document.getElementById("fechaSegunda").value = h.seg.fecha; }
            if (h.ter) { document.getElementById("diaTerca").checked = h.ter.aberto; document.getElementById("abreTerca").value = h.ter.abre; document.getElementById("fechaTerca").value = h.ter.fecha; }
            if (h.qua) { document.getElementById("diaQuarta").checked = h.qua.aberto; document.getElementById("abreQuarta").value = h.qua.abre; document.getElementById("fechaQuarta").value = h.qua.fecha; }
            if (h.qui) { document.getElementById("diaQuinta").checked = h.qui.aberto; document.getElementById("abreQuinta").value = h.qui.abre; document.getElementById("fechaQuinta").value = h.qui.fecha; }
            if (h.sex) { document.getElementById("diaSexta").checked = h.sex.aberto; document.getElementById("abreSexta").value = h.sex.abre; document.getElementById("fechaSexta").value = h.sex.fecha; }
            if (h.sab) { document.getElementById("diaSabado").checked = h.sab.aberto; document.getElementById("abreSabado").value = h.sab.abre; document.getElementById("fechaSabado").value = h.sab.fecha; }
            if (h.dom) { document.getElementById("diaDomingo").checked = h.dom.aberto; document.getElementById("abreDomingo").value = h.dom.abre; document.getElementById("fechaDomingo").value = h.dom.fecha; }
        }
    }

    /* REDES SOCIAIS */
    function salvarRedes() {
        let whats = document.getElementById("whatsappRede").value.trim().replace(/\D/g, '');
        if (whats && !whats.startsWith("55")) whats = "55" + whats;

        const redes = {
            instagram: document.getElementById("instagram").value.trim(),
            facebook: document.getElementById("facebook").value.trim(),
            tiktok: document.getElementById("tiktok").value.trim(),
            whatsapp: whats,
            googleAvaliacoes: document.getElementById("googleAvaliacoes").value.trim()
        };
        localStorage.setItem("hubRedes", JSON.stringify(redes));
        alert("Redes sociais salvas com sucesso!");
    }

    function carregarRedes() {
        const redes = JSON.parse(localStorage.getItem("hubRedes") || "{}");
        if (redes.instagram) document.getElementById("instagram").value = redes.instagram;
        if (redes.facebook) document.getElementById("facebook").value = redes.facebook;
        if (redes.tiktok) document.getElementById("tiktok").value = redes.tiktok;
        if (redes.googleAvaliacoes) document.getElementById("googleAvaliacoes").value = redes.googleAvaliacoes;

        let whats = redes.whatsapp || "";
        if (whats.startsWith("55") && whats.length > 10) whats = whats.substring(2);
        document.getElementById("whatsappRede").value = whats;
    }

    /* WHATSAPP & PROMOÇÕES DA SEMANA */
    function obterUrlDelivery() {
        let base = window.location.href.substring(0, window.location.href.lastIndexOf('/') + 1);
        return base + "cardapioweb.php";
    }

    function dispararLinkWhatsApp() {
        let url = obterUrlDelivery();
        let msg = `Olá! Acesse nosso cardápio online e faça seu pedido:\n${url}`;
        window.open(`https://api.whatsapp.com/send?text=${encodeURIComponent(msg)}`, '_blank');
    }

    function copiarMensagemWhatsApp() {
        let url = obterUrlDelivery();
        let msg = `Olá! Acesse nosso cardápio online e faça seu pedido:\n${url}`;
        navigator.clipboard.writeText(msg).then(() => alert("Mensagem copiada para a área de transferência!"));
    }

    function gerarTextoPromocao() {
        const titulo = document.getElementById("promoTitulo").value.trim();
        const corpo = document.getElementById("promoCorpo").value.trim();
        const url = obterUrlDelivery();

        return `*${titulo}*\n\n${corpo}\n\n👉 *Acesse o Cardápio:* ${url}`;
    }

    function dispararPromocaoWhatsApp() {
        const texto = gerarTextoPromocao();
        window.open(`https://api.whatsapp.com/send?text=${encodeURIComponent(texto)}`, '_blank');
    }

    function copiarPromocaoWhatsApp() {
        const texto = gerarTextoPromocao();
        navigator.clipboard.writeText(texto).then(() => alert("Texto da promoção copiado! Agora você pode colar na sua lista de transmissão do WhatsApp."));
    }

    /* APARÊNCIA */
    function carregarAparencia() {
        const aparencia = JSON.parse(localStorage.getItem("hubAparencia") || "{}");
        document.getElementById("selectModeloLayout").value = aparencia.modelo || "hub_classico";
        if (aparencia.principal) {
            document.getElementById("aparenciaCorPrincipal").value = aparencia.principal;
            document.getElementById("aparenciaCorPrincipalHex").value = aparencia.principal;
        }
        if (aparencia.secundaria) {
            document.getElementById("aparenciaCorSecundaria").value = aparencia.secundaria;
            document.getElementById("aparenciaCorSecundariaHex").value = aparencia.secundaria;
        }
    }

    function salvarAparenciaOnlineManual() {
        const aparencia = JSON.parse(localStorage.getItem("hubAparencia") || "{}");
        aparencia.principal = document.getElementById("aparenciaCorPrincipalHex").value;
        aparencia.secundaria = document.getElementById("aparenciaCorSecundariaHex").value;
        aparencia.modelo = document.getElementById("selectModeloLayout").value;
        localStorage.setItem("hubAparencia", JSON.stringify(aparencia));
        alert("Aparência online salva!");
    }

    function renderizarCategorias() {
        const c = document.getElementById("listaCategorias");
        c.innerHTML = "";
        const todasCats = [
            ...produtosPainel.map(p => formatarCategoria(p.categoria)),
            ...produtosLojaFisica.map(p => formatarCategoria(p.categoria))
        ].filter(Boolean);

        const catsUnicas = [...new Set(todasCats)];
        catsUnicas.forEach(cat => {
            const div = document.createElement("div");
            div.className = "category";
            div.innerHTML = `<strong>${cat}</strong>`;
            c.appendChild(div);
        });
    }

    function atualizarDashboard() {
        document.getElementById("totalProdutos").textContent = produtosPainel.length;
        document.getElementById("totalProdutosLoja").textContent = produtosLojaFisica.length;
        document.getElementById("produtosAtivos").textContent = produtosPainel.filter(p => p.disponivel !== false).length;
        document.getElementById("totalDestaques").textContent = produtosPainel.filter(p => p.destaque).length;
    }

    function exportarDados() {
        const backup = {
            produtos: produtosPainel,
            produtosLoja: produtosLojaFisica,
            modeloLoja: localStorage.getItem("hubModeloLoja") || "hub_classico",
            telefoneCozinha: localStorage.getItem("hubTelefoneCozinha") || "",
            loja: JSON.parse(localStorage.getItem("hubLoja") || "{}"),
            aparencia: JSON.parse(localStorage.getItem("hubAparencia") || "{}"),
            redes: JSON.parse(localStorage.getItem("hubRedes") || "{}")
        };
        const blob = new Blob([JSON.stringify(backup, null, 2)], { type: "application/json" });
        const a = document.createElement("a");
        a.href = URL.createObjectURL(blob);
        a.download = `backup-lauanne-${Date.now()}.json`;
        a.click();
    }

    function limparDados() {
        if (confirm("Apagar todos os dados locais?")) {
            localStorage.clear();
            location.reload();
        }
    }

    document.addEventListener("DOMContentLoaded", () => {
        carregarDadosLoja();
        carregarRedes();
        atualizarDashboard();
        renderizarProdutos();
        renderizarCategorias();
        carregarAparencia();
        carregarModuloCardapioLoja();
    });
</script>

</body>
</html>
