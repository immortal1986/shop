{{ content() }}
{{ form("producttypes/save", 'role': 'form') }}
{{ partial('admin/form_top_nav',['src':'producttypes']) }}

<h2>Edit Product Types</h2>



<fieldset>

    {% for element in form %}
        {% if is_a(element, 'Phalcon\Forms\Element\Hidden') %}
            {{ element }}
        {% else %}
            <div class="form-group">
                {{ element.label(['class': 'control-label']) }}
                <div class="controls">
                    {{ element }}
                </div>
            </div>
        {% endif %}
    {% endfor %}

</fieldset>

</form>
