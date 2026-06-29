# Symfony Bundle Pack

[![Packagist](https://img.shields.io/packagist/v/ton-vendor/symfony-bundle-pack)](https://packagist.org/packages/ton-vendor/symfony-bundle-pack)
[![PHP](https://img.shields.io/badge/PHP-8.1%2B-blue)](https://www.php.net)
[![Symfony](https://img.shields.io/badge/Symfony-6.4%20%7C%207.x-black)](https://symfony.com)
[![License](https://img.shields.io/badge/license-MIT-green)](LICENSE)

Pack de configuration prêt à l'emploi pour intégrer rapidement les bundles Symfony les plus utilisés.

## Bundles inclus

- **EasyAdminBundle** `^4.8` — Interface d'administration
- **StofDoctrineExtensionsBundle** `^1.7` — Timestampable, Sluggable, SoftDelete
- **LiipImagineBundle** `^2.3` — Traitement d'images
- **VichUploaderBundle** `^2.3` — Upload de fichiers liés aux entités
- **DoctrineFixturesBundle** `^3.5` — Données de test

---

## Installation

```bash
composer require ton-vendor/symfony-bundle-pack
```

Puis lancer la commande d'installation pour copier les configs et entités dans ton projet :

```bash
php bin/console bundle-pack:install
```

---

## Ce qui est installé

### Fichiers de configuration
| Fichier | Description |
|--------|-------------|
| `config/packages/security.yaml` | Firewalls, rôles, contrôle d'accès |
| `config/packages/doctrine.yaml` | ORM + filtre SoftDelete |
| `config/packages/liip_imagine.yaml` | Filtres thumbnail, banner, profile |
| `config/packages/vich_uploader.yaml` | Mappings product_image, user_avatar |
| `config/packages/stof_doctrine_extensions.yaml` | Behaviors activés |
| `config/routes.yaml` | Routes app + LiipImagine |

### Entités
| Entité | Traits / Features |
|--------|-------------------|
| `User` | Security, VichUploader (avatar), Timestampable, SoftDelete |
| `Product` | Sluggable, VichUploader (image), Timestampable, SoftDelete |

### Controllers admin (EasyAdmin)
- `DashboardController` — Dashboard avec menu
- `ProductCrudController` — CRUD Produits avec image
- `UserCrudController` — CRUD Utilisateurs

### Sécurité
- `AppAuthenticator` — Login avec redirection par rôle

### Fixtures
- `UserFixtures` — 1 admin (`admin@example.com` / `Admin1234!`) + 20 users aléatoires
- `ProductFixtures` — 30 produits aléatoires

---

## Étapes post-installation

```bash
# 1. Configurer la base de données dans .env.local
DATABASE_URL="mysql://user:password@127.0.0.1:3306/ma_base"

# 2. Créer la base et les migrations
php bin/console doctrine:database:create
php bin/console doctrine:migrations:diff
php bin/console doctrine:migrations:migrate

# 3. Charger les fixtures (dev uniquement)
php bin/console doctrine:fixtures:load
```

---

## Personnalisation

Les fichiers copiés dans ton projet t'appartiennent. Tu peux les modifier librement :
- Ajouter des champs à `User.php` ou `Product.php`
- Ajouter des CRUD dans `DashboardController.php`
- Modifier les filtres d'images dans `liip_imagine.yaml`
- Ajouter des mappings d'upload dans `vich_uploader.yaml`

---

## Licence

MIT — voir [LICENSE](LICENSE)
