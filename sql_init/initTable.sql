TRUNCATE TABLE house, reservation, message, page RESTART IDENTITY;
-- TRUNCATE TABLE message RESTART IDENTITY;
INSERT INTO house(name, price, content, description, minimum_night, maximum_personnes, visible) VALUES('appartement la bresse', 200, 'contenue', 'Appartement tout confort au cœur du village de La Bresse', 2, 4, TRUE);
INSERT INTO house(name, price, content, description, minimum_night, maximum_personnes, visible) VALUES('Gîte de Liézey', 200, 'contenue', 'description', 2, 4, TRUE);
INSERT INTO reservation(house, starting_date, end_date) VALUES(1, date '2024-03-10', date '2024-03-15');
INSERT INTO message(name, motif, content, email, phone, date) VALUES('Jerome', 'Reservation Appartement', 'du 15 au 30 de ce mois ci c est possible?', 'Jerome@jerome.je', '0602322003', CURRENT_DATE);
INSERT INTO page(name, title, sub_title, content) VALUES('accueil', 'Location d''hébergements touristiques dans les Hautes Vosges', 'Appartement et gîte meublés pour tout type de vacanciers', '<h3>Idéal pour des vacances dans l''esprit montagne et sportif</h3><p>L''équipe vous souhaites la bienvenue. </p><p>Location de maison sur Gérardmer, la Bresse et ses alentoure. Pour petite familles et grande famille.</p>');
INSERT INTO alert(content) VALUES('accueil');