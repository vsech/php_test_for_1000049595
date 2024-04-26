# Тестовое 1000049595

Этот проект представляет собой простую систему управления пользователями и группами с использованием PHP и MySQL.

## Установка

1. Клонируйте репозиторий
2. Создайте файл .env в корневой директории проекта и укажите параметры подключения к базе данных:

```
DB_HOST=localhost
DB_USER=username
DB_PASS=password
DB_NAME=myDB
```

3. Создайте таблицы в базе данных и добавьте демонстрационные данные:

```
php fake_migration.php
```

## Использование

### REST API для работы с пользователями и группами

- **Добавление пользователя в группу**

```
POST /UserGroupApi.php?action=addUserToGroup
{
"userId": 1,
"groupId": 1
}
```

- **Удаление пользователя из группы**

```
POST /UserGroupApi.php?action=removeUserFromGroup
{
"userId": 1,
"groupId": 1
}
```

- **Получение списка групп и прав для пользователя**

```
GET /UserGroupApi.php?action=getUserGroupsAndPermissions&userId=1
```

- **Добавление пользователя**

```
POST /UserApi.php?action=addUser
{
"userId": 1,
"name": "John"
}
```

- **Удаление пользователя**

```
POST /UserApi.php?action=deleteUser
{
"userId": 1
}
```

- **Получение информации о пользователе**

```
GET /UserApi.php?action=getUserInfo&userId=1
```

## Тестирование

Для запуска тестов выполните следующие команды:

```
phpunit UserManagerTest.php
```

```
phpunit UserGroupManagerTest.php
```
