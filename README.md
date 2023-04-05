# Email Validator
## Установка

1. Создаем контейнер 
`docker-compose build`

2. Поднимаем контейнер `docker-compose up -d`

## Использование

1. Проваливаемся внутрь контейнера, где будем использовать консольные команды `docker exec -it project_app bash`
2. Выполняем команду `php bin/console validate:email -your_email-`

- Ответ при валидном email: *There is good news. Email -your_email- is valid!*
- Ответ при невалидном email: *There is a problem. Email -your_email- is not valid!*
