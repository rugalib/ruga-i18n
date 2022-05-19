## Create file list

```powershell
c:/bin/find "../../src" -name *.php >filelist.txt
```



## Create messages.pot

```
c:/bin/gettext/bin/xgettext --no-wrap --files-from=filelist.txt --language=PHP --keyword=_ --keyword=__ --keyword=translate --keyword="translatePlural:1,2" --from-code="UTF-8" --add-location --output=messages.pot
```



