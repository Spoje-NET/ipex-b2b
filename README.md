# Ipex-b2b
![Ipex-b2b Logo](https://github.com/Spoje-NET/Ipex-b2b/raw/master/ipex-b2b-logo.png "Project Logo")



CZ: PHP Knihovna pro snadnou práci s Rest API [IPEX B2B](https://restapi.ipex.cz/documentation)

[![Source Code](http://img.shields.io/badge/source/Spoje-NET/ipex-b2b-blue.svg?style=flat-square)](https://github.com/Spoje-NET/ipex-b2b)
[![Latest Version](https://img.shields.io/github/release/Spoje-NET/ipex-b2b.svg?style=flat-square)](https://github.com/Spoje-NET/ipex-b2b/releases)
[![Software License](https://img.shields.io/badge/license-GNU-brightgreen.svg?style=flat-square)](https://github.com/Spoje-NET/ipex-b2b/blob/master/LICENSE)
[![Total Downloads](https://img.shields.io/packagist/dt/spoje.net/ipex-b2b.svg?style=flat-square)](https://packagist.org/packages/spoje.net/ipex-b2b)
[![Latest stable](https://img.shields.io/packagist/v/spoje.net/ipex-b2b.svg?style=flat-square)](https://packagist.org/packages/spoje.net/ipex-b2b)

# Poděkování 
Vznik této knihovny by nebyl možný bez laskavé podpory společnosti [Spoje.Net](http://www.spoje.net), 
která hradila vývoj řešení pro navýšení kreditu na VoIP služby. :+1:

![Spoje.Net](https://github.com/Spoje-NET/Ipex-b2b/raw/master/spoje-net_logo.gif "Spoje.Net")

U společnosti Spoje.Net, je možné si objednat komerční podporu pro integraci
knihovny do vašich projektů.

Instalace
---------

    composer require spojenet/ipexb2b

Konfigurace
-----------

Konfigurace se provádí nastavením následujících konstant:

```php
/**
 * Write logs as:
 */
define('LOG_NAME', 'IPEXB2B_Test');
define('LOG_TYPE', 'syslog');

/*
 * URL ipex-b2b API
 */
define('IPEX_URL', 'https://restapi.ipex.cz');
/*
 * Uživatel ipex-b2b API
 */
define('IPEX_LOGIN', 'firma_api');
/*
 * Heslo ipex-b2b API
 */
define('IPEX_PASSWORD', 'Ceeghul');

```

nebo je možné přihlašovací údaje zadávat při vytváření instance třídy.

```php
    $pravnik = new \IPEXB2B\Rights(null,[
                'url' => 'https://testapi.ipex.cz',
                'user' => 'resttest',
                'password' => '-dj3x21xaA_'
            ]);
```

Tento způsob nastavení má vyšší prioritu než výše uvedené definovaní konstant.

Jak to celé funguje ?
---------------------

Ústřední komponentou celé knihovny je Třída ApiClient, která je schopna pomocí 
PHP rozšíření curl komunikovat s REST Api IPEX.

Z ní jsou pak odvozeny třídy pro jednotlivé sekce, obsahující metody pro 
často používané operace, například "Navyš kredit" v případě VoIP.

Nová odvozená třída vzniká tak že jméno třídy je název sekce.

Tzn. Pokud chceme odvodit 
novou třídu pro sekci "simcards" bude vypadat takto:

```php
    <?php
    class Simcards extends /IPEXB2B/ApiClient
    {
        /**
         * Evidence užitá objektem.
         *
         * @var string
         */
        public $evidence = 'merna-jednotka';
    }
```

A poté je již snadné si simkarty na 2 řádky vypsat:
    
```php
    $jednotky = new Simcards();
    print_r( $jednotky->requestData() );
```

Docker
------

    docker pull vitexsoftware/ipex-b2b

Debian/Ubuntu
-------------

Pro Linux jsou k dispozici .deb balíčky. Prosím použijte repo:


```shell
sudo apt install lsb-release wget apt-transport-https bzip2

sudo wget -O /usr/share/keyrings/vitexsoftware.gpg https://repo.vitexsoftware.cz/keyring.gpg
echo "deb [signed-by=/usr/share/keyrings/vitexsoftware.gpg]  https://repo.vitexsoftware.cz  $(lsb_release -sc) main" | sudo tee /etc/apt/sources.list.d/vitexsoftware.list
sudo apt update

sudo apt install php-spojenet-ipex-b2b
```


V tomto případě je potřeba do souboru composer.json vaší aplikace přidat:

```json
    "require": {
        "deb/ipex-b2b": "*",
        "deb/ease-core": "*"
    },
    "repositories": [
        {
            "type": "path",
            "url": "/usr/share/php/IPEXB2B",
            "options": {
                "symlink": true
            }
        },
        {
            "type": "path",
            "url": "/usr/share/php/EaseCore",
            "options": {
                "symlink": true
            }
        }
    ]
```

Takže při instalaci závislostí bude vypadat nějak takto:

    Loading composer repositories with package information
    Installing dependencies from lock file
      - Installing deb/ease-framework (1.24)
        Symlinked from /usr/share/php/Ease

      - Installing deb/ipex-b2b (0.2.1)
        Symlinked from /usr/share/php/IPEXB2B

A aktualizaci bude možné dělat globálně pro celý systém prostřednictvím apt-get.
