<nav class="navbar navbar-default" role="navigation">
    <a class="navbar-brand" href="{{ url() }}">{{ brand }}</a>
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            {{ elements.getMenu() }}
        </div>
    </div>
</nav>

<div class="container">
    {{ flash.output() }}
    {{ content() }}
    <hr>
    {{ partial('footer') }}
</div>
