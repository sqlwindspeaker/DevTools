
function timestamp()
{
    date "+%s"
}

function today()
{
    SEP=${1:-}
    date "+%Y${SEP}%m${SEP}%d"
}

function now()
{
    date "+%Y%m%d%H%M%S"
}
