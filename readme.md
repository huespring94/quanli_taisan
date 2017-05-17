## Yêu cầu cài đặt:

- Git
- Docker
- Docker-compose
- Bower

## Hướng dẫn cài đặt:
- Đầu tiên
```bash
git clone git@github.com:huespring94/quanli_taisan.git
```
hoặc
```bash 
git clone https://github.com/huespring94/quanli_taisan.git
 ```

- Tạo file .env và copy nội dung file .env.example vào 

- Vào thư mục laradock,

    ```bash
    sudo docker-compose build
    ```
    ```bash
    sudo docker-compose up -d mysql nginx
    ```
    ```bash
    sudo docker exec -it laradock_workspace_1 bash
    ```
    ```bash
    composer install
    ```
    ```bash
    php artisan key:generate
    ```

- Tạo datbase tên quanli_db

- Gõ 
```bash
php artisan migrate
```
```bash
php artisan db:seed
```
