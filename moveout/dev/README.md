# DRKN website

This is the repository for the DRKN website, only plugins and the "drkn" theme will be included in this repository.  A complete development version with all files and a config can be found under releases.

### Development release

As mentioned you can find a complete development version with all files, but not neceserally with the latest commits, in "Releases". The development release includes a wp-config file which uses a remote MySql-database, that we share, and a shared Amazon S3 bucket for file storage - so that we all can work with the same data. This wp-install is configured to run on localhost/drkn, if you want to use a different development url you will need to create a local mysql-database that you use. Haven't tested this approach before so I hope that it works!

### Installation

1. Clone this repo (A)
2. Download the WP-install from https://github.com/vbelius/drkn/releases (B)
3. Put WP-install (B) inside repo root folder (A)

### Specification, Screens & Image material

Below you can find the latest specification document, screens and image material for the website.

[Dropbox folder](https://www.dropbox.com/sh/p0l7i6cyq9g5lo8/AADz_Fu-dEpLV5oByI-5EDD_a?dl=0)

### Development database

You can download the development database as an SQL-file [here](http://www.vbelius.se/drkn-demo/.push/downloaddb.php).

### Meet the team!

**Vilhelm Belius**
Customer interaction, code review

**Babovic Marko**
Theme / frontend development

**Sanna Frese**
Wordpress guru, custom post types

**Richard Herries** (coalescecreate)
Silk (e-commerce) integration

### Credentials

```
WORDPRESS
user: admin
password: nordquist
```
```
MYSQL (Google app engine server in europe)
host: 173.194.255.254
database: drkn_dev
user: drkn-dev
password: nordquist
```
```
AMAZON S3
Bucket: drkn-dev
Bucket zone: eu‑central‑1
Access Key ID: AKIAIFZ4DUH5KSFJORIA
Secret Access Key: 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
```
