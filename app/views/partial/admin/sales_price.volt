<div class="row">
    <div class="col-md-10 list_price">
        <h4>Список активных акций</h4>
        <hr>
        {% for sales in sales_list %}
            {% if sales is empty %}
                <span>нету акций</span>
            {% else %}
                <span class="text-warning">Цена </span>${{ sales.price }}
                <span class="text-warning">с </span>{{ sales.date_start }}
                <span class="text-warning">по </span>{{ sales.date_end }}
                <span class="text-warning">Продолжительность акции: </span>{{ sales.days_to_end }} дней
                <span class="text-warning">Окончание через: </span>{{ date('d',strtotime(sales.date_end ) - strtotime('now')) }} дней
                {{ link_to("products/salesdelete/" ~ sales.id, '<i class="glyphicon glyphicon-remove"></i> ', "class": "btn btn-sm btn-danger") }}
                <br>
            {% endif %}
        {% endfor %}
    </div>
    <div class="col-md-2">
        <h4>Добавить акционую цену</h4>
        <hr>
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#sales_Modal">New Sales Price</button>
    </div>
</div>
