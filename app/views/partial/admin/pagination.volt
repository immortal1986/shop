<nav aria-label="...">
    <ul class="pagination justify-content-end mt-3 mr-3">
        <li class="page-item ">
            <span class="page-link">   {{ link_to(page_name ~ "/search?page=" ~ page.before, '<i class="icon-step-backward"></i> Previous', "class": "page-link") }}</span>
        </li>
        <li class="page-item">
            {{ link_to(page_name ~ "/search", '<i class="icon-fast-backward"></i> First', "class": "btn") }}
        </li>
        <li class="page-item active">
            <span class="page-link">{{ page.current }}<span class="sr-only">(current)</span></span>
        </li>
        <li class="page-item">
            {{ link_to(page_name ~ "/search?page=" ~ page.last, '<i class="icon-fast-forward"></i> Last', "class": "btn page-link") }}
        </li>
        <li class="page-item">
            {{ link_to(page_name ~ "/search?page=" ~ page.next, '<i class="icon-step-forward"></i> Next', "class": "page-link") }}
        </li>
    </ul>
</nav>
