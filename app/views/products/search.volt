{{ content() }}
{{ partial('admin/top_nav',['page_name':'products','p_n':'Create products']) }}

{% for product in page.items %}
    {% if loop.first %}
        <table class="table table-hover" align="center">
        <thead>
        <tr>
            <th>Id</th>
            <th>Product Type</th>
            <th>Name</th>
            <th>Price</th>
            <th>Akciy Price</th>
            <th>Active</th>
        </tr>
        </thead>
        <tbody>
    {% endif %}
    <tr>
        <td>{{ product.id }}</td>
        <td>{{ product.getProductTypes().name }}</td>
        <td>{{ product.name }}</td>
        <td>${{ "%.2f"|format(product.price) }}</td>
        <td> SALES PRICE LIST (if need..)</td>
        <td>{{ product.getActiveDetail() }}</td>
        {{ partial('admin/edit_btn',['page_name':'products','product':product]) }}
    </tr>
    {% if loop.last %}
        </tbody>
        <tfoot>
        <tr>
            <td colspan="7" align="right">
                <div class="card-footer p-0">
                    {{ partial('admin/pagination',['page_name':'products']) }}
                </div>
            </td>
        </tr>
        </tfoot>
        </table>
    {% endif %}
{% else %}
    No products are recorded
{% endfor %}
