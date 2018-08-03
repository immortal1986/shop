{{ form("producttypes/create", "autocomplete": "off") }}

<h2 class="text-left text-danger">New product types</h2>
<hr>

{{ partial('admin/form_top_nav',['src':'producttypes']) }}

{{ content() }}

<div class="center scaffold">
    <div class="clearfix">
        <label for="name">Name</label>
        {{ text_field("name", "size": 24, "maxlength": 70) }}
    </div>

</div>
</form>
