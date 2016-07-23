is_date()
{
    echo $1 | grep -E '^\d{4}-[01]\d-[0-3]\d$' > /dev/null
}

function timestamp()
{
    if [ $# -eq 0 ]; then
        date "+%s"
    else
        DATE=$1
        TIME=${2:-"00:00:00"}
        date -j -f "%Y-%m-%d %H:%M:%S" "$DATE $TIME" "+%s"
    fi
}

function datetime()
{
    if [ $# -eq 0 ]; then
        date "+%Y-%m-%d %H:%M:%S"
    else
        date -j -f "%s" "$1" "+%Y-%m-%d %H:%M:%S"
    fi
}

function today()
{
    date "+%Y-%m-%d"
}
