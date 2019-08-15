$source="E:\Dev\wordpress\plugins\include-fussball-de-widgets\app\dist\"
$dest="E:\Environment\fubade\app\public\wp-content\plugins\include-fussball-de-widgets\"

Remove-Item -Path $dest* -Recurse
Copy-Item -Path $source* -Destination $dest -Recurse
