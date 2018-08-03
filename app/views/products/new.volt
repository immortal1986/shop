{{ form("products/create") }}

<h2 class="text-left text-danger">New product</h2>
<hr>
{{ partial('admin/form_top_nav',['src':'products']) }}
{{ content() }}

<fieldset>

    {% for element in form %}
        {% if is_a(element, 'Phalcon\Forms\Element\Hidden') %}
            {{ element }}
        {% else %}
            <div class="form-row">
                <div class="form-group  col-md-4">
                    {{ element.label() }}
                    {{ element.render(['class': 'form-control']) }}
                </div>
            </div>
        {% endif %}
    {% endfor %}

</fieldset>

</form>
