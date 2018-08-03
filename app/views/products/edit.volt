{{ content() }}

{{ form("products/save", 'role': 'form') }}
{{ partial('admin/form_top_nav',['src':'products']) }}




<h2>Edit products</h2>
<fieldset>

    {% for element in form %}
        {% if is_a(element, 'Phalcon\Forms\Element\Hidden') %}
            {{ element }}
        {% else %}
            <div class="form-group">
                {{ element.label() }}
                {{ element.render(['class': 'form-control']) }}
            </div>
        {% endif %}
    {% endfor %}

</fieldset>

</form>

{{ partial('admin/modal') }}

{{ partial('admin/sales_price') }}
