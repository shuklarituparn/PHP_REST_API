# PHP_REST_API 🚀️




![flat_750x_075_f-pad_750x1000_f8f8f8 u4__1_-removebg-preview](https://github.com/shuklarituparn/MarketPlace/assets/66947051/caac7684-0c38-41d1-8f17-759acf3a26f8)

RESTFUL API написано в чистом ПХП без фреймворков 


---

## Технологический стек

- **Бэкенд**: PHP
- **Базы данных**:  MySQL
- **Панель управления базами данных**: adminer
- **Развертывание**: Docker, Docker-compose
- **CI/CD**: Github Actions, Gitlab
- **Testing**: httpie

---

## Первые шаги (docker-compose) 🔧


* Клонируйте проект, выполнив следующую команду:

    `git@github.com:shuklarituparn/PHP_REST_API.git`
    

* Теперь выполните следующую команду, чтобы убедиться, что вы находитесь в корневой директории проекта:

    `cd PHP_REST_API`


* Находясь в в корневой директории проекта, выполните следующую команду, чтобы запустить: `docker compose up`

> Убедитесь, что у вас установлен Docker перед выполнением вышеуказанной команды


* Cервис доступен по адресу `localhost:8086`, но еще нам все равно нужно выполнить миграцию таблицы


* Открываете панель управления базами данных который доступен по адресу `localhost:8080`

* по умолчанию `usernmame=root`, `password=example`, `database=sample-rest-api`

![image](https://github.com/shuklarituparn/MarketPlace/assets/66947051/8aae02f7-dc36-458d-ba53-6b1dd3468168)

* откройте окно sql commands и запустите запрос из api/database в следующем порядке
  
` - 00.categories.sql`  - чтобы создать таблицы категории

 `- 00.insert_into_categories.sql` - дамп таблицы категории

` - 01.products.sql`  - чтобы создать таблицы продукты

` - 01.insert_into_products.sql`  -  дамп таблицы продукты


![image](https://github.com/shuklarituparn/Conversion-Microservice/assets/66947051/dadd944e-96aa-40b7-a314-caa5009022ec)

---

##  Использование 🐘

- Используя httpie мы сможем выполнить запрос к апи

`http localhost:8086/api/product/read_one.php?id=1`

![Screenshot from 2024-04-21 19-25-25](https://github.com/shuklarituparn/Conversion-Microservice/assets/66947051/e6df2897-a885-4b9c-b8e9-3f3f40cb565c)






## Лицензия 📄

Этот проект лицензирован под [лицензией MIT](LICENSE).
