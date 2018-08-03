<div class="row">
    <div class="col-md-7">
        <h5>Список активных акций</h5>
        <hr>
        {% for sales in sales_list %}
            {% if sales is empty %}
                <span>нету акций</span>
            {% else %}
                <span class="text-warning">Цена </span>${{ sales.price }}
                <span class="text-warning">с </span>{{ sales.date_start }}
                <span class="text-warning">по </span>{{ sales.date_end }}
                <span class="text-warning">Окончание через: </span>{{ sales.days_to_end }}
                {{ partial('admin/edit_btn',['page_name':'products','product':sales,'src':'sales_']) }}
                <br>
            {% endif %}
        {% endfor %}
    </div>
    <div class="col-md-5">
        <h5>Добавить акционую цену</h5>
        <hr>
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#sales_Modal">New Sales Price</button>
    </div>
</div>
