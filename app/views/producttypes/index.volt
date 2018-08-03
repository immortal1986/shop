{{ content() }}

{{ partial("admin/top_btn", ['src':'producttypes','page': "Create product types"]) }}

{{ form("producttypes/search", "autocomplete": "off") }}

<div class="form-row text-left">

    <h2>Search product types</h2>
    <hr>
    <div class="form-group">
        {{ numeric_field("id", "size": 10, "maxlength": 10) }}
        <label for="id">Id</label>
    </div>

    <div class="form-group">
        {{ text_field("name", "size": 24, "maxlength": 70) }}
        <label for="name">Name</label>

    </div>

    <div class="form-group">
        {{ submit_button("Search", "class": "btn btn-primary") }}
    </div>

</div>

</form>
