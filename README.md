# 🗺️ Visit Map

Uma aplicação web elegante para registrar e gerenciar seus lugares favoritos visitados.

## 📋 Descrição

**Visit Map** é uma aplicação web intuitiva que permite aos usuários registrar e organizar todos os lugares que visitaram. Com funcionalidades completas de cadastro e autenticação, você pode:

- ✨ **Cadastrar-se** e fazer login de forma segura
- 📍 **Adicionar lugares** com informações detalhadas:
  - Nome do local
  - Endereço completo
  - Data da visita
  - Avaliação pessoal
- ✏️ **Editar** registros existentes
- 🗑️ **Excluir** lugares da sua lista

O projeto foi desenvolvido com **PHP puro** e utiliza **MongoDB** como banco de dados para máxima flexibilidade e performance.

---

## ⚙️ Requisitos do Sistema

Antes de iniciar, certifique-se de que seu ambiente possui:

- 🐘 **PHP** >= 8.0
- 🍃 **MongoDB Community Server** instalado e executando localmente (porta padrão: `27017`)
- 🔌 **Extensão MongoDB para PHP** (`php_mongodb.dll`) habilitada
- 📦 **Composer** instalado globalmente

### 🔧 Instalação da Extensão MongoDB para PHP (CRÍTICO)

A instalação da extensão MongoDB é **OBRIGATÓRIA** e deve ser feita com muita atenção à compatibilidade de versões:

#### 📥 Download da Extensão

1. **Acesse o PECL oficial:** https://pecl.php.net/package/mongodb
2. **Ou baixe diretamente do GitHub:** https://github.com/mongodb/mongo-php-driver/releases

#### ⚠️ Escolha da Versão Correta

É ESSENCIAL selecionar o arquivo DLL que corresponda exatamente às propriedades do seu PHP:

- **Versão do PHP** (8.0, 8.1, 8.2, 8.3, etc.)
- **Arquitetura** (x86 ou x64)
- **Thread Safety** (TS ou NTS)
- **Compilador** (VC14, VC15, VS16, etc.)

Para descobrir essas informações, execute `php -m` no terminal ou crie um arquivo PHP com `<?php phpinfo(); ?>`.

#### 📁 Instalação Manual

1. Extraia o arquivo `php_mongodb.dll` para a pasta `/ext` do PHP
   ```
   Exemplo: C:\xampp\php\ext\php_mongodb.dll
   ```

2. Adicione a linha no arquivo `php.ini`:
   ```ini
   extension=php_mongodb.dll
   ```

3. **Reinicie o servidor web** (Apache/Nginx)

#### ✅ Verificação da Instalação

Execute no terminal:
```bash
php -m | grep mongodb
```

Ou crie um arquivo PHP:
```php
<?php
if (extension_loaded('mongodb')) {
    echo "MongoDB extension loaded successfully!";
} else {
    echo "ERROR: MongoDB extension not loaded!";
}
?>
```

## 🚀 Instalação

Siga estes passos para configurar o projeto em seu ambiente local:

### 1. Clone o Repositório
```bash
git clone <[URL_DO_REPOSITORIO](https://github.com/eduardobotelho28/visit-map)>
cd visit-map
```

### 2. Instale as Dependências
```bash
composer install
```

### 3. Configure o Ambiente (Opcional)
O projeto já possui configurações padrão, mas você pode personalizar criando um arquivo `.env` na raiz:

```ini
MONGODB_URI=mongodb://localhost:27017
MONGODB_DB=visitmap
```

### 4. Execute o Servidor
```bash
php -S localhost:8000 -t public
```

> ⚠️ **Importante:** O parâmetro `-t public` é **essencial** para que as rotas funcionem corretamente.

### 5. Acesse a Aplicação
Abra seu navegador e acesse: `http://localhost:8000`

---

## 🔮 Funcionalidades Futuras

- 🗺️ **Integração com Google Maps** para visualização geográfica dos lugares
- 📊 **Dashboard** com estatísticas de viagens
- 📱 **Interface responsiva** otimizada para mobile
- 🌐 **Compartilhamento** de listas de lugares
- 📸 **Upload de fotos** dos locais visitados

---

## 💻 Tecnologias Utilizadas

| Tecnologia | Versão | Uso |
|------------|--------|-----|
| PHP | >= 8.0 | Backend e lógica principal |
| MongoDB | Latest | Banco de dados NoSQL |
| Composer | Latest | Gerenciamento de dependências |

