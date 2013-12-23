CREATE TABLE debt (
id INTEGER PRIMARY KEY AUTOINCREMENT,
plan_id INTEGER NOT NULL,
priority INTEGER,
name TEXT,
start_dt TEXT,
amt REAL,
created TEXT DEFAULT CURRENT_TIMESTAMP,
updated TEXT DEFAULT CURRENT_TIMESTAMP,
FOREIGN KEY(plan_id) REFERENCES dplan(id)
);
create index debti1 on debt (id);
create trigger debttri after insert on debt begin
        update debt set start_dt = datetime('now','localtime','start of month')
	, priority = 1 + (select max(priority) from debt where plan_id = new.plan_id)
	where id = new.id;
        end;
create trigger debttr after update on debt begin
        update debt set updated = datetime('now','localtime') where id = new.id;
        end;

insert into debt (plan_id, name, amt) values (1, 'CC', 1000);
insert into debt (plan_id, name, amt) values (1, 'Mortgage', 200000);



CREATE TABLE debt_adj (
id INTEGER PRIMARY KEY AUTOINCREMENT,
debt_id INTEGER NOT NULL,
name TEXT,
start_dt TEXT,
amt REAL,
created TEXT DEFAULT CURRENT_TIMESTAMP,
updated TEXT DEFAULT CURRENT_TIMESTAMP,
FOREIGN KEY(debt_id) REFERENCES debt(id)
);
create index debt_adji1 on debt (id);
/*
create trigger debtt_adjri after insert on debt_adj begin
        update debt_adj set created = datetime('now','localtime'), updated = datetime('now','localtime') where id = new.id;
        end;
*/
create trigger debt_adjtr after update on debt_adj begin
        update debt_adj set updated = datetime('now','localtime') where id = new.id;
	end;

insert into debt_adj (debt_id, name, start_dt, amt) values (1,'Test Raise', datetime('now','localtime','start of month','+2 months'), 250); 
