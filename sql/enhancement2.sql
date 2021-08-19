-- 1
INSERT INTO clients
(clientFirstname, clientLastname, clientEmail, clientPassword, comment)
VALUES
('Tony', 'Stark', 'tony@starkent.com', 'Iam1ronM@n', 'I am the real Ironman');

-- 2
UPDATE
clients
SET
clientLevel = 3
WHERE
clientId = 2;

-- 3
UPDATE
inventory
SET invDescription = replace(invDescription, 'small', 'spacious')
where invModel = 'Hummer';

-- 4
SELECT inventory.invModel, carclassification.classificationName
FROM inventory
INNER JOIN carclassification ON inventory.classificationId = carclassification.classificationId
WHERE carclassification.classificationId = 1;

-- 5
DELETE
FROM
inventory
WHERE
invModel = "Wrangler";

-- 6
UPDATE
inventory
SET
invImage = concat("/phpmotors", invImage), invThumbnail = concat("/phpmotors", invThumbnail);