<h1 align="center">Project Symfony</h1>

## Comands

```
docker-compose up -d --build
```

### Acess php folder
```
 docker-compose exec php /bin/bash
```

### Acess mysql
```
 docker-compose exec database /bin/bash
```

### Install
```
composer req --dev maker ormfixtures fakerphp/faker doctrine twig serializer
```

### Config Database acess:
 DATABASE_URL="mysql://root:secret@database:3306/symfony_docker?serverVersion=8.0"


Molde Docker [https://www.twilio.com/blog/get-started-docker-symfony]