# Site Maristela Medeiros

Website institucional da nutricionista **Maristela Medeiros**, desenvolvido em WordPress com tema customizado e pipeline moderno de assets via **Webpack 5**.

---

## 🚀 Tecnologias Utilizadas

- **WordPress** (CMS)
- **PHP 8+** (Templates de Tema & Custom Post Types)
- **Webpack 5** (Sistema de Build, Bundling & PurgeCSS)
- **SASS / SCSS** & **Bootstrap 4** (Estilização modular)
- **JavaScript (ES6+)** / jQuery / Owl Carousel / jQuery Mask
- **BrowserSync** (Live-reload em ambiente local)

---

## 📁 Estrutura de Pastas do Tema

O tema principal do projeto encontra-se em `wp-content/themes/maristela-medeiros-2022`:

```text
wp-content/themes/maristela-medeiros-2022/
├── gulp/                          # Arquivos fonte de assets
│   ├── scss/                      # Estilos SCSS (style.scss, home.scss, critical.scss, components/)
│   ├── js/                        # Scripts JS fonte (main.js)
│   └── images/                    # Imagens originais do tema
├── css/                           # CSS final gerado e purgado pelo Webpack
├── js/                            # JS final minificado (scripts.min.js, libs)
├── images/                        # Imagens otimizadas pelo Webpack
├── template-parts/                # Componentes reutilizáveis PHP (modais, etc.)
├── functions.php                  # Configurações do tema, scripts, estilos e Post Types
├── header.php                     # Topo da página e navegação
├── footer.php                     # Rodapé da página e redes sociais
├── front-page.php                 # Template da página inicial
├── index.php                      # Template principal
├── style.css                      # Cabeçalho de identificação do Tema WordPress
└── wp_bootstrap_navwalker.php     # Walker para menus Bootstrap
```

---

## 🛠️ Instalação e Desenvolvimento

### Pré-requisitos
- **Node.js** (v18+)
- **NPM**
- Ambiente WordPress local (ex: Local WP, XAMPP, Docker)

### Passo a Passo

1. **Instalar dependências de desenvolvimento**:
   ```bash
   npm install
   ```

2. **Compilar assets para Produção**:
   ```bash
   npm run build
   ```
   *Compila os arquivos SCSS, aplica o PurgeCSS escaneando os arquivos PHP do tema, minifica os arquivos JavaScript e otimiza as imagens.*

3. **Modo Desenvolvimento (Watch + Live Reload)**:
   ```bash
   npm run dev
   ```
   *Executa o Webpack no modo watch para recompilar automaticamente alterações em arquivos SCSS, JS e PHP.*

---

## 🛡️ Segurança e Controle de Versão (Git)

- **Controle de Versão Enxuto**: O arquivo `.gitignore` está configurado para controlar a versão apenas do tema e arquivos de configuração do projeto (`package.json`, `webpack.config.js`). Os arquivos de core do WordPress (`/wp-admin/`, `/wp-includes/`, `/wp-*.php`) e plugins (`/wp-content/plugins/`) não são versionados.
- **Sanitização no PHP**: Todos os links, URLs de ativos e saídas de texto utilizam funções nativas de escaping do WordPress (`esc_url()`, `esc_attr()`, `esc_html()`, `sanitize_file_name()`).
- **Segurança de Queries**: Utilização estrita de `wp_reset_postdata()` para evitar corrupção da query principal do WordPress.
