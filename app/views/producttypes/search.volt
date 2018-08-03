{{ content() }}
{{ partial('admin/top_nav',['page_name':'producttypes','p_n':'Create product types']) }}

{% for producttype in page.items %}
    {% if loop.first %}
        <table class="table table-hover" align="center">
        <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
        </tr>
        </thead>
        <tbody>
    {% endif %}
    <tr>
        <td>{{ producttype.id }}</td>
        <td>{{ producttype.name }}</td>
        {{ partial('admin/edit_btn',['page_name':'producttypes','product':producttype]) }}
    </tr>
    {% if loop.last %}
        </tbody>
        <tfoot>
        <tr>
            <td colspan="7" align="right">
                <div class="card-footer p-0">
                    {{ partial('admin/pagination',['page_name':'producttypes']) }}
                </div>
            </td>
        </tr>
        </tfoot>
        </table>
    {% endif %}
{% else %}
    No product types are recorded
{% endfor %}
