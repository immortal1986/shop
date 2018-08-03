{{ get_doctype() }}
<html>
    <head>
        <meta charset="utf-8">
        {{ get_title() }}
        {{ partial('css') }}
        {{ partial('meta') }}
    </head>
    <body>
        {{ content() }}
        {{ partial('js') }}
    </body>
</html>
