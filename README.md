[![Sonarcloud Status](https://sonar.internal.intelipost.com.br/api/project_badges/measure?project=magento-tracking-v1&metric=alert_status)](https://sonar.internal.intelipost.com.br/dashboard?id=magento-tracking-v1)
[![Maintainability Rating](http://sonar.internal.intelipost.com.br/api/project_badges/measure?project=magento-tracking-v1&metric=sqale_rating)](http://sonar.internal.intelipost.com.br/dashboard?id=magento-tracking-v1)
[![Reliability Rating](http://sonar.internal.intelipost.com.br/api/project_badges/measure?project=magento-tracking-v1&metric=reliability_rating)](http://sonar.internal.intelipost.com.br/dashboard?id=magento-tracking-v1)
[![Security Rating](http://sonar.internal.intelipost.com.br/api/project_badges/measure?project=magento-tracking-v1&metric=security_rating)](http://sonar.internal.intelipost.com.br/dashboard?id=magento-tracking-v1)
[![SonarCloud Coverage](http://sonar.internal.intelipost.com.br/api/project_badges/measure?project=magento-tracking-v1&metric=coverage)](http://sonar.internal.intelipost.com.br/component_measures/metric/coverage/list?id=magento-tracking-v1)
[![SonarCloud Bugs](http://sonar.internal.intelipost.com.br/api/project_badges/measure?project=magento-tracking-v1&metric=bugs)](http://sonar.internal.intelipost.com.br/component_measures/metric/reliability_rating/list?id=magento-tracking-v1)
[![SonarCloud Vulnerabilities](http://sonar.internal.intelipost.com.br/api/project_badges/measure?project=magento-tracking-v1&metric=vulnerabilities)](http://sonar.internal.intelipost.com.br/component_measures/metric/security_rating/list?id=magento-tracking-v1)
[![Code Smells](http://sonar.internal.intelipost.com.br/api/project_badges/measure?project=magento-tracking-v1&metric=code_smells)](http://sonar.internal.intelipost.com.br/dashboard?id=magento-tracking-v1)
[![Duplicated Lines (%)](http://sonar.internal.intelipost.com.br/api/project_badges/measure?project=magento-tracking-v1&metric=duplicated_lines_density)](http://sonar.internal.intelipost.com.br/dashboard?id=magento-tracking-v1)
[![Lines of Code](http://sonar.internal.intelipost.com.br/api/project_badges/measure?project=magento-tracking-v1&metric=ncloc)](http://sonar.internal.intelipost.com.br/dashboard?id=magento-tracking-v1)
[![Technical Debt](http://sonar.internal.intelipost.com.br/api/project_badges/measure?project=magento-tracking-v1&metric=sqale_index)](http://sonar.internal.intelipost.com.br/dashboard?id=magento-tracking-v1)

# :rocket: magento-tracking-v1

Plugin de Tracking no Magento v1.

## Squad
Conectividade

## Sumário

* [Começando](#Começando)
* [Documentação](#Documentação)
* [Pré-requisitos](#Pré-requisitos)
* [Instalação](#Instalação)
* [Executando os testes](#Executando-os-testes)
* [Deployment](#Deployment)
* [Ambientes](#Ambientes)
* [Stack desenvolvimento](#Stack-desenvolvimento)
* [Contribuições](#Contribuições)
* [Versionamento](#Versionamento)
* [Licença](#Licença)

## Começando

As instruções a seguir irão lhe proporcionar uma cópia deste projeto e de como rodar em sua máquina local para propósito de desenvolvimento e testes. Veja na sessão de [deployment](#Deployment) para saber com mais detalhes de como dar deploy em sua aplicação.

### Documentação

Você pode descobrir mais sobre a aplicação através do nosso Confluence ou Swagger
* [Confluence](https://esprinter.atlassian.net/wiki/spaces/IN/pages/7957610720/Notification+Conversor)
* [Swagger]()

### Pré-requisitos

Dependências necessárias para se instalar o software e como instalá-las.

1. É necessário que você tenha `PHP >= 7.1` instalado na sua máquina. Para verificar, rode o seguinte comando:

```bash
$ php -version
```

2. Necessário ter o `Composer` também. Verifique através do comando:

```bash
$ composer -vvv about

```

### Instalação

Para rodar a aplicação, execute os próximos passos:

1. Faça o clone do projeto:

```bash
$ git clone https://github.com/intelipost/magento-tracking-v1.git
```

2. Entre na pasta do projeto:

```bash
$ cd magento-tracking-v1
```

3. Instale todas as dependencias usando o composer:

```bash
$ composer install
```

Caso não tenha, executa o seguinte comando:

```bash
$ composer install --no-dev --optimize-autoloader
```

```bash
$ composer dump-autoload --no-dev --optimize
```

## Executando os testes

Para rodar os testes automáticos do seu sistema siga os comandos abaixo:

```bash
# rodando todos testes unitários com cobertura de código
$ vendor/bin/phpunit --coverage-text

# rodando todos testes unitários com cobertura de código e gerando gráficos
$ vendor/bin/phpunit --coverage-html destinationFolder
````

## Deployment

* [Jenkins](https://builds.intelipost.com.br/job/magento-tracking-v1) - Pipeline Deploy
* [SonarQube](http://sonar.internal.intelipost.com.br/dashboard?id=magento-tracking-v1) - Qualidade do código

## Ambientes

* [QA]() - Ambiente para testes
* [Produção]() - Ambiente produtivo

## Stack desenvolvimento

* [PHP](https://www.php.net/) - Linguagem principal
* [Composer](https://getcomposer.org/) - Gerenciador dependências

## Contribuições

Por favor leia [CONTRIBUTING.md](CONTRIBUTING.md) para mais detalhes a respeito do nosso código de contuda e o processo de submissão de pull-requests para nós.

## Versionamento

Nós usamos [GitHub](https://github.com/) para versionamento. Para visualizar as versões disponíveis veja [tags nesse repositórios](https://github.com/your/project/tags).

Veja também a lista completa de [contribuidores](https://github.com/your/project/contributors) que contribuiram para o desenvolvimento deste projeto.

## Licença

Esse projeto é licenciado pela MIT License - veja também [LICENSE.md](LICENSE.md) para mais detalhes



