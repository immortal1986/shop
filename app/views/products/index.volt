{{ content() }}
{{ partial("admin/top_btn", ['src':'products','page': "Create products"]) }}

<h2>Search products</h2>

{{ form("products/search") }}

<fieldset>

    {% for element in form %}
        {% if is_a(element, 'Phalcon\Forms\Element\Hidden') %}
            {{ element }}
        {% else %}
    <div class="form-row">
            <div class="form-group col-md-6">
                {{ element.label(['class': 'control-label']) }}
                <div class="controls">
                    {{ element }}
                </div>
            </div>
            </div>
        {% endif %}
    {% endfor %}
    <br>
    <div class="control-group">
        {{ submit_button("Search", "class": "btn btn-primary") }}
    </div>

</fieldset>

</form>
