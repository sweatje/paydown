CREATE TABLE dplan (
id INTEGER PRIMARY KEY AUTOINCREMENT,
name TEXT,
start_dt TEXT,
created TEXT DEFAULT CURRENT_TIMESTAMP,
updated TEXT DEFAULT CURRENT_TIMESTAMP
);
create index dplani1 on dplan (id);
create trigger dplantri after insert on dplan begin
        update dplan set start_dt = datetime('now','localtime','start of month') where id = new.id;
        end;
create trigger dplantr after update on dplan begin
        update dplan set updated = datetime('now','localtime') where id = new.id;
        end;
