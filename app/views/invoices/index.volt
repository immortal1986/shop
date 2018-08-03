<h2>Main System Settings</h2>

<div class="container">
    <div class="row">
        <div class="col-md-4">
            <h5>DataBase Status</h5>
            <hr>
            <span>Всего товаров :</span> <span class="text-info"> {{ product_cnt }} </span> <br>
            <span>Категорий :</span> <span class="text-info"> {{ product_type_cnt }} </span><br>
            <span>Пользавателей :</span> <span class="text-info"> {{ user_cnt }} </span><br>
        </div>
        <div class="col-md-4">
            <h5>System Settings</h5>
            <hr>
        </div>
        <div class="col-md-4">
            <h5>Server Information</h5>
            <hr>
            <span>Адресс сервера :</span> <span class="text-info"> {{ ip_server }} </span> <br>
            <span>Адресс клиента :</span> <span class="text-info"> {{ ip_client }} </span><br>
            <span>Агент :</span> <span class="text-info"> {{ user_agent }} </span><br>
            <span>Кодировка :</span> <span class="text-info"> {{ charset }} </span><br>
            <span>Язык :</span> <span class="text-info"> {{ language }} </span><br>
        </div>
    </div>
</div>

