drop table if exists message CASCADE;
drop table if exists reservation CASCADE;
drop table if exists house CASCADE;
drop table if exists admin CASCADE;
drop table if exists page CASCADE;
drop table if exists alert CASCADE;


create table message (
   id SERIAL primary key,
   name varchar(20) not null,
   motif varchar(80) not null,
   content varchar(400) not null,
   email varchar(40) not null,
   phone varchar(12) not null,
   date date not null
);

create table house (
   id SERIAL primary key,
   name varchar(40) not null,
   price double precision not null,
   content text not null,
   description varchar(100) not null,
   minimum_night smallint not null DEFAULT 1,
   maximum_personnes smallint not null DEFAULT 2,
   alert integer,
   visible boolean DEFAULT '0'
);
create table page (
   name varchar(100) primary key,
   alert integer,
   title varchar(100) not null,
   sub_title varchar(100),
   content text not null
);
create table alert (
   id SERIAL primary key,
   content text not null
);

create table reservation (
   id SERIAL primary key,
   house integer not null references house(id),
   starting_date date not null,
   end_date date not null

);

create table admin (
   id SERIAL primary key,
   pseudo varchar(20) not null UNIQUE,
   password varchar(150) not null,
   ip varchar(25) not null
);


CREATE OR REPLACE FUNCTION get_house_paire_name_id() 
RETURNS TABLE(name varchar(40), id integer) 
AS $$
BEGIN
   RETURN QUERY
   SELECT l.name, l.id FROM all_visble_location() l;
END;
$$ LANGUAGE plpgsql;


CREATE OR REPLACE FUNCTION all_visble_location() 
RETURNS SETOF house 
AS $$
BEGIN
   RETURN QUERY
   SELECT * FROM house h WHERE h.visible=TRUE;
END;
$$ LANGUAGE plpgsql;


CREATE OR REPLACE FUNCTION all_locationable_at_date(starting date, ending date)
RETURNS SETOF house
AS $$
BEGIN
   RETURN QUERY
   SELECT * FROM all_visble_location()
   WHERE id NOT IN(
      SELECT l.id FROM all_visble_location() l JOIN reservation r ON l.id=r.house WHERE (r.starting_date <= starting AND r.end_date >= starting) OR (r.starting_date <= ending AND r.end_date >= ending) OR (r.starting_date >= starting AND r.end_date <= ending)
   );
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION house_is_not_revserved(id_house integer   , starting date, ending date)
RETURNS boolean
AS $$
DECLARE not_revserved BOOLEAN;
BEGIN
   SELECT (COUNT(*)=1) INTO not_revserved FROM all_locationable_at_date(starting, ending) l WHERE l.id=id_house;
   
   RETURN not_revserved;
END;
$$ LANGUAGE plpgsql;

TRUNCATE TABLE house, reservation, message, page RESTART IDENTITY;
-- TRUNCATE TABLE message RESTART IDENTITY;
INSERT INTO house(name, price, content, description, minimum_night, maximum_personnes, visible) VALUES('appartement la bresse', 200, 'contenue', 'Appartement tout confort au cœur du village de La Bresse', 2, 4, TRUE);
INSERT INTO house(name, price, content, description, minimum_night, maximum_personnes, visible) VALUES('Gîte de Liézey', 200, 'contenue', 'description', 2, 4, TRUE);
INSERT INTO reservation(house, starting_date, end_date) VALUES(1, date '2024-03-10', date '2024-03-15');
INSERT INTO message(name, motif, content, email, phone, date) VALUES('Jerome', 'Reservation Appartement', 'du 15 au 30 de ce mois ci c est possible?', 'Jerome@jerome.je', '0602322003', CURRENT_DATE);
INSERT INTO page(name, title, sub_title, content) VALUES('accueil', 'Location d''hébergements touristiques dans les Hautes Vosges', 'Appartement et gîte meublés pour tout type de vacanciers', '<h3>Idéal pour des vacances dans l''esprit montagne et sportif</h3><p>L''équipe vous souhaites la bienvenue. </p><p>Location de maison sur Gérardmer, la Bresse et ses alentoure. Pour petite familles et grande famille.</p>');
INSERT INTO alert(content) VALUES('accueil');

