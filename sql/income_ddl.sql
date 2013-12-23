CREATE TABLE income (
id INTEGER PRIMARY KEY AUTOINCREMENT,
plan_id INTEGER NOT NULL,
name TEXT,
start_dt TEXT,
amt REAL,
created TEXT DEFAULT CURRENT_TIMESTAMP,
updated TEXT DEFAULT CURRENT_TIMESTAMP,
FOREIGN KEY(plan_id) REFERENCES dplan(id)
);
create index incomei1 on income (id);
create trigger incometri after insert on income begin
        update income set start_dt = datetime('now','localtime','start of month') where id = new.id;
        end;
create trigger incometr after update on income begin
        update income set updated = datetime('now','localtime') where id = new.id;
        end;

insert into income (plan_id, name, amt) values (1, 'Job', 8000);



CREATE TABLE income_adj (
id INTEGER PRIMARY KEY AUTOINCREMENT,
income_id INTEGER NOT NULL,
name TEXT,
start_dt TEXT,
amt REAL,
created TEXT DEFAULT CURRENT_TIMESTAMP,
updated TEXT DEFAULT CURRENT_TIMESTAMP,
FOREIGN KEY(income_id) REFERENCES income(id)
);
create index income_adji1 on income (id);
/*
create trigger incomet_adjri after insert on income_adj begin
        update income_adj set created = datetime('now','localtime'), updated = datetime('now','localtime') where id = new.id;
        end;
*/
create trigger income_adjtr after update on income_adj begin
        update income_adj set updated = datetime('now','localtime') where id = new.id;
	end;

insert into income_adj (income_id, name, start_dt, amt) values (1,'Test Raise', datetime('now','localtime','start of month','+2 months'), 250); 
