
{% if src is empty  %}
    {% set src = '' %}
{% else %}
    {% set src = 'sales' %}
{% endif %}

<td width="7%">{{ link_to(page_name~"/"~src~"edit/" ~ product.id, '<i class="glyphicon glyphicon-edit"></i> ', "class": "btn btn-sm btn-warning") }}</td>
<td width="7%">{{ link_to(page_name~"/"~src~"delete/" ~ product.id, '<i class="glyphicon glyphicon-remove"></i> ', "class": "btn btn-sm btn-danger") }}</td>
