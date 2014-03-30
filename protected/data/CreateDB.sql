-- Note that comment lines need to end with a semicolon for CreateDB.java to work;

-- The primary keys (id) should really be CHAR(40), not VARCHAR(40), but;
-- to make life easier in testing, I've placed them as VARCHAR(40) for now;

-- First drop everything (order matters here for foreign keys!);


DROP TABLE IF EXISTS generalledger;
DROP TABLE IF EXISTS membership;
DROP TABLE IF EXISTS conceptualrental;
DROP TABLE IF EXISTS forsale;
DROP TABLE IF EXISTS forrent;
DROP TABLE IF EXISTS damage;
DROP TABLE IF EXISTS late;
DROP TABLE IF EXISTS fee;
DROP TABLE IF EXISTS rental;
DROP TABLE IF EXISTS online;
DROP TABLE IF EXISTS instore;
DROP TABLE IF EXISTS sale;
DROP TABLE IF EXISTS storeproduct;
DROP TABLE IF EXISTS physicalproduct;
DROP TABLE IF EXISTS conceptualproduct;
DROP TABLE IF EXISTS product;
DROP TABLE IF EXISTS revenuesource;
DROP TABLE IF EXISTS transaction;
DROP TABLE IF EXISTS printorder;
DROP TABLE IF EXISTS picture;
DROP TABLE IF EXISTS print;
DROP TABLE IF EXISTS customer;
DROP TABLE IF EXISTS payment;
DROP TABLE IF EXISTS commission;
DROP TABLE IF EXISTS employee;
DROP TABLE IF EXISTS store;
DROP TABLE IF EXISTS debitcredit;
DROP TABLE IF EXISTS journalentry;
DROP TABLE IF EXISTS businessobject;


-- BUSINESSOBJECT TABLE (everything extends this);
CREATE TABLE businessobject (
  id           VARCHAR(40) PRIMARY KEY,
  botype       VARCHAR(250)
);


-- Journal Entry TABLE;
CREATE TABLE journalentry (
  id           VARCHAR(40) PRIMARY KEY REFERENCES businessobject(id),
  jedate       DATE
);

INSERT INTO businessobject(id, botype) VALUES ('jeid1', 'edu.byu.isys413.data.JournalEntry');
INSERT INTO journalentry(id, jedate) VALUES ('jeid1', '2013-01-01');
INSERT INTO businessobject(id, botype) VALUES ('jeid2', 'edu.byu.isys413.data.JournalEntry');
INSERT INTO journalentry(id, jedate) VALUES ('jeid2', '2013-01-02');
INSERT INTO businessobject(id, botype) VALUES ('jeid3', 'edu.byu.isys413.data.JournalEntry');
INSERT INTO journalentry(id, jedate) VALUES ('jeid3', '2013-01-03');
INSERT INTO businessobject(id, botype) VALUES ('jeid4', 'edu.byu.isys413.data.JournalEntry');
INSERT INTO journalentry(id, jedate) VALUES ('jeid4', '2013-01-04');


-- Debit Credit TABLE;
CREATE TABLE debitcredit (
  id             VARCHAR(40) PRIMARY KEY REFERENCES businessobject(id),
  jeid 			 VARCHAR(40) REFERENCES journalentry(id),
  debitcredit    BOOLEAN,
  amount         DOUBLE,
  glname         VARCHAR(100)
);

INSERT INTO businessobject(id, botype) VALUES ('dcid1', 'edu.byu.isys413.data.DebitCredit');
INSERT INTO debitcredit(id, jeid, debitcredit, amount, glname) VALUES ('dcid1', 'jeid1', true, 1, 'Cash');
INSERT INTO businessobject(id, botype) VALUES ('dcid2', 'edu.byu.isys413.data.DebitCredit');
INSERT INTO debitcredit(id, jeid, debitcredit, amount, glname) VALUES ('dcid2', 'jeid2', true, 2, 'Sales Revenue');
INSERT INTO businessobject(id, botype) VALUES ('dcid3', 'edu.byu.isys413.data.DebitCredit');
INSERT INTO debitcredit(id, jeid, debitcredit, amount, glname) VALUES ('dcid3', 'jeid3', false, 3, 'Tax Expense');
INSERT INTO businessobject(id, botype) VALUES ('dcid4', 'edu.byu.isys413.data.DebitCredit');
INSERT INTO debitcredit(id, jeid, debitcredit, amount, glname) VALUES ('dcid4', 'jeid4', false, 4, 'Commission Payable');


-- Store TABLE;
CREATE TABLE store (
  id           VARCHAR(40) PRIMARY KEY REFERENCES businessobject(id),
  location     VARCHAR(250),
  address      VARCHAR(250),
  city         VARCHAR(100),
  state        VARCHAR(100),
  zip          VARCHAR(100),
  phone        VARCHAR(100),
  managerid    VARCHAR(40),
  taxrate      VARCHAR(40),
  subnet	   VARCHAR(40)
);

INSERT INTO businessobject(id, botype) VALUES ('store1', 'edu.byu.isys413.data.Store');
INSERT INTO store(id, location, address, city, state, zip, phone, managerid, taxrate, subnet) VALUES ('store1', 'Sandy', '300 S 400W', 'Sandy', 'UT', '84059', '(801) 832-2310', 'emp1', '0.07', '00-15-5D-01-4F-5D');
INSERT INTO businessobject(id, botype) VALUES ('store2', 'edu.byu.isys413.data.Store');
INSERT INTO store(id, location, address, city, state, zip, phone, managerid, taxrate, subnet) VALUES ('store2', 'Provo', '402 University Ave.', 'Provo', 'UT', '84606', '(801) 822-4359', 'emp2', '0.07', '00-26-C7-3B-59-14');
INSERT INTO businessobject(id, botype) VALUES ('store3', 'edu.byu.isys413.data.Store');
INSERT INTO store(id, location, address, city, state, zip, phone, managerid, taxrate, subnet) VALUES ('store3', 'Gateway', '300 S Temple Suite 402', 'Salt Lake City', 'UT', '85034', '(801) 854-3485', 'emp3', '0.07', '00-26-C7-3B-59-16');
INSERT INTO businessobject(id, botype) VALUES ('store4', 'edu.byu.isys413.data.Store');
INSERT INTO store(id, location, address, city, state, zip, phone, managerid, taxrate, subnet) VALUES ('store4', 'Payson', '803 E Center St.', 'Payson', 'UT', '83409', '(801) 453-8917', 'emp4', '0.07', '00-26-C7-3B-59-17');


-- Employee TABLE;
CREATE TABLE employee (
  id           VARCHAR(40) PRIMARY KEY REFERENCES businessobject(id),
  firstname    VARCHAR(250),
  middlename   VARCHAR(250),
  lastname     VARCHAR(250),
  phone        VARCHAR(100),
  hiredate     DATE,
  salary       NUMERIC(8,2),
  username     VARCHAR(100),
  password     VARCHAR(100),
  passsalt     VARCHAR(100),
  storeid      VARCHAR(40) REFERENCES store(id)
);

INSERT INTO businessobject(id, botype) VALUES ('emp1', 'edu.byu.isys413.data.Employee');
INSERT INTO employee(id, firstname, middlename, lastname, phone, hiredate, salary, username, password, passsalt, storeid) VALUES ('emp1', 'Garrett', 'K', 'Scott', '(801) 454-3214', '2013-01-01', '1000.00', 'Garrett', '98199b80a1d79568ac5c6d56a28d46e27434ce063c36ae7b27d635979abb9f15','salt1', 'store1');
INSERT INTO businessobject(id, botype) VALUES ('emp2', 'edu.byu.isys413.data.Employee');
INSERT INTO employee(id, firstname, middlename, lastname, phone, hiredate, salary, username, password, passsalt, storeid) VALUES ('emp2', 'Ken', 'L', 'Townsend', '(801) 234-3445', '2013-01-02', '2000.00', 'Ken', '98199b80a1d79568ac5c6d56a28d46e27434ce063c36ae7b27d635979abb9f15','salt1', 'store2');
INSERT INTO businessobject(id, botype) VALUES ('emp3', 'edu.byu.isys413.data.Employee');
INSERT INTO employee(id, firstname, middlename, lastname, phone, hiredate, salary, username, password, passsalt, storeid) VALUES ('emp3', 'Scott', 'Q', 'Barn', '(801) 544-2938', '2013-01-03', '3000.00', 'Scott', '98199b80a1d79568ac5c6d56a28d46e27434ce063c36ae7b27d635979abb9f15', 'salt1','store3');
INSERT INTO businessobject(id, botype) VALUES ('emp4', 'edu.byu.isys413.data.Employee');
INSERT INTO employee(id, firstname, middlename, lastname, phone, hiredate, salary, username, password, passsalt, storeid) VALUES ('emp4', 'Evan', 'M', 'Fife', '(801) 634-9483', '2013-01-04', '4000.00', 'Evan', '98199b80a1d79568ac5c6d56a28d46e27434ce063c36ae7b27d635979abb9f15','salt1','store4');


-- Commission TABLE;
CREATE TABLE commission (
  id           VARCHAR(40) PRIMARY KEY REFERENCES businessobject(id),
  empid	       VARCHAR(40) REFERENCES employee(id),
  cdate        DATE,
  amount       DECIMAL(8,2)
);

INSERT INTO businessobject(id, botype) VALUES ('commid1', 'edu.byu.isys413.data.Commission');
INSERT INTO commission(id, empid, cdate, amount) VALUES ('commid1', 'empid1', '2013-01-01', 1);
INSERT INTO businessobject(id, botype) VALUES ('commid2', 'edu.byu.isys413.data.Commission');
INSERT INTO commission(id, empid, cdate, amount) VALUES ('commid2', 'empid2', '2013-01-02', 2);
INSERT INTO businessobject(id, botype) VALUES ('commid3', 'edu.byu.isys413.data.Commission');
INSERT INTO commission(id, empid, cdate, amount) VALUES ('commid3', 'empid3', '2013-01-03', 3);
INSERT INTO businessobject(id, botype) VALUES ('commid4', 'edu.byu.isys413.data.Commission');
INSERT INTO commission(id, empid, cdate, amount) VALUES ('commid4', 'empid4', '2013-01-04', 4);


-- Payment TABLE;
CREATE TABLE payment (
  id           VARCHAR(40) PRIMARY KEY REFERENCES businessobject(id),
  amount       DOUBLE,
  pchange      DOUBLE,
  paytype      VARCHAR(40)
);

INSERT INTO businessobject(id, botype) VALUES ('payid1', 'edu.byu.isys413.data.Payment');
INSERT INTO payment(id, amount, pchange, paytype) VALUES ('payid1', 1, 0, 'Card');
INSERT INTO businessobject(id, botype) VALUES ('payid2', 'edu.byu.isys413.data.Payment');
INSERT INTO payment(id, amount, pchange, paytype) VALUES ('payid2', 2, 0, 'Card');
INSERT INTO businessobject(id, botype) VALUES ('payid3', 'edu.byu.isys413.data.Payment');
INSERT INTO payment(id, amount, pchange, paytype) VALUES ('payid3', 3, 13, 'Cash');
INSERT INTO businessobject(id, botype) VALUES ('payid4', 'edu.byu.isys413.data.Payment');
INSERT INTO payment(id, amount, pchange, paytype) VALUES ('payid4', 4, 14, 'Cash');


-- Customer TABLE;
CREATE TABLE customer (
  id           VARCHAR(40) PRIMARY KEY REFERENCES businessobject(id),
  name         VARCHAR(250),
  phone        VARCHAR(100),
  email        VARCHAR(100), 
  address        VARCHAR(250),  
  city           VARCHAR(100),  
  state          VARCHAR(100),  
  zip            VARCHAR(100),
  password       VARCHAR(100),
  passsalt       VARCHAR(100),
  validationcode VARCHAR(100),
  validated      BOOLEAN,
  memid          VARCHAR(40) REFERENCES customer(id)
);

INSERT INTO businessobject(id, botype) VALUES ('cust1', 'edu.byu.isys413.data.Customer');
INSERT INTO customer(id, name, phone, email, address, city, state, zip, password, passsalt, validated ) VALUES ('cust1', 'Garrett Schroath', 'phone1', 'gtschroath@gmail.com', 'address1', 'city1', 'state1', 'zip1', '98199b80a1d79568ac5c6d56a28d46e27434ce063c36ae7b27d635979abb9f15', 'salt1', true);
INSERT INTO businessobject(id, botype) VALUES ('cust2', 'edu.byu.isys413.data.Customer');
INSERT INTO customer(id, name, phone, email, address, city, state, zip, password, passsalt, validated ) VALUES ('cust2', 'Scott Carlson', '3852081444', 'shuaiscott@gmail.com', 'address2', 'city2', 'state2', 'zip2', '98199b80a1d79568ac5c6d56a28d46e27434ce063c36ae7b27d635979abb9f15', 'salt1', true);
INSERT INTO businessobject(id, botype) VALUES ('cust3', 'edu.byu.isys413.data.Customer');
INSERT INTO customer(id, name, phone, email, address, city, state, zip, password, passsalt, validated) VALUES ('cust3', 'Evan Cox', 'phone3', 'epic1988@gmail.com', 'address3', 'city3', 'state3', 'zip3', '98199b80a1d79568ac5c6d56a28d46e27434ce063c36ae7b27d635979abb9f15', 'salt1', true);
INSERT INTO businessobject(id, botype) VALUES ('cust4', 'edu.byu.isys413.data.Customer');
INSERT INTO customer(id, name, phone, email, address, city, state, zip, password, passsalt, validated) VALUES ('cust4', 'Kenneth Cline', 'phone4', 'polycline@gmail.com', 'address4', 'city4', 'state4', 'zip4', '98199b80a1d79568ac5c6d56a28d46e27434ce063c36ae7b27d635979abb9f15', 'salt1', true);

-- Picture TABLE;
CREATE TABLE picture (
  id             VARCHAR(40) PRIMARY KEY REFERENCES businessobject(id),
  custid         VARCHAR(40) REFERENCES customer(id),
  caption        VARCHAR(250),
  picture        LONGTEXT
);
INSERT INTO businessobject(id, botype) VALUES ('pic1', 'edu.byu.isys413.data.Picture');
INSERT INTO picture(id, caption, picture, custid) VALUES ('pic1','CatCat','/9j/4AAQSkZJRgABAQEAYABgAAD/2wBDAAMCAgMCAgMDAwMEAwMEBQgFBQQEBQoH
BwYIDAoMDAsKCwsNDhIQDQ4RDgsLEBYQERMUFRUVDA8XGBYUGBIUFRT/2wBDAQME
BAUEBQkFBQkUDQsNFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQU
FBQUFBQUFBQUFBQUFBT/wAARCAEVAW0DASIAAhEBAxEB/8QAHwAAAQUBAQEBAQEA
AAAAAAAAAAECAwQFBgcICQoL/8QAtRAAAgEDAwIEAwUFBAQAAAF9AQIDAAQRBRIh
MUEGE1FhByJxFDKBkaEII0KxwRVS0fAkM2JyggkKFhcYGRolJicoKSo0NTY3ODk6
Q0RFRkdISUpTVFVWV1hZWmNkZWZnaGlqc3R1dnd4eXqDhIWGh4iJipKTlJWWl5iZ
mqKjpKWmp6ipqrKztLW2t7i5usLDxMXGx8jJytLT1NXW19jZ2uHi4+Tl5ufo6erx
8vP09fb3+Pn6/8QAHwEAAwEBAQEBAQEBAQAAAAAAAAECAwQFBgcICQoL/8QAtREA
AgECBAQDBAcFBAQAAQJ3AAECAxEEBSExBhJBUQdhcRMiMoEIFEKRobHBCSMzUvAV
YnLRChYkNOEl8RcYGRomJygpKjU2Nzg5OkNERUZHSElKU1RVVldYWVpjZGVmZ2hp
anN0dXZ3eHl6goOEhYaHiImKkpOUlZaXmJmaoqOkpaanqKmqsrO0tba3uLm6wsPE
xcbHyMnK0tPU1dbX2Nna4uPk5ebn6Onq8vP09fb3+Pn6/9oADAMBAAIRAxEAPwCl
Y28YaVehfofStg2qGJAWwAOSRXP2l4DheAz8A9xW01w3kZVsFMZrfoc7uYeqxiW6
SIkDNZV7IqM2eFAwMVpJJ9pupJ2XcEJ6msO+nWZtoUg7j3rGRrFW0LOko3no4GVJ
wRXr/hCwWGDeVyAc15r4Jw0s0ckRJfaI/wCte9+HdNjSwxtG0jFdFGF1dGFWXKZ0
MaTXDSKcsGxSatqSWkDAMMdCKtzxJZuzgY2nOa8z8X+JY/tLhSR7LXROfIjCEXMT
VL7zp85Gdx4qtcyRx2xbcAD2xXLSatvuTluAcjb1q9qOpFkiVOCcY+tcClc7VGx0
Hh+xhu70M4faO7Ct7WrSL7KsS9WPasPSgbSzUscu3XntSX+voLiFGPygY3elaKVl
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','cust1');
INSERT INTO businessobject(id, botype) VALUES ('pic2', 'edu.byu.isys413.data.Picture');
INSERT INTO picture(id, caption, picture , custid) VALUES ('pic2','Meow','/9j/4AAQSkZJRgABAQEAYABgAAD/2wBDAAMCAgMCAgMDAwMEAwMEBQgFBQQEBQoH
BwYIDAoMDAsKCwsNDhIQDQ4RDgsLEBYQERMUFRUVDA8XGBYUGBIUFRT/2wBDAQME
BAUEBQkFBQkUDQsNFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQU
FBQUFBQUFBQUFBQUFBT/wAARCAEVAW0DASIAAhEBAxEB/8QAHwAAAQUBAQEBAQEA
AAAAAAAAAAECAwQFBgcICQoL/8QAtRAAAgEDAwIEAwUFBAQAAAF9AQIDAAQRBRIh
MUEGE1FhByJxFDKBkaEII0KxwRVS0fAkM2JyggkKFhcYGRolJicoKSo0NTY3ODk6
Q0RFRkdISUpTVFVWV1hZWmNkZWZnaGlqc3R1dnd4eXqDhIWGh4iJipKTlJWWl5iZ
mqKjpKWmp6ipqrKztLW2t7i5usLDxMXGx8jJytLT1NXW19jZ2uHi4+Tl5ufo6erx
8vP09fb3+Pn6/8QAHwEAAwEBAQEBAQEBAQAAAAAAAAECAwQFBgcICQoL/8QAtREA
AgECBAQDBAcFBAQAAQJ3AAECAxEEBSExBhJBUQdhcRMiMoEIFEKRobHBCSMzUvAV
YnLRChYkNOEl8RcYGRomJygpKjU2Nzg5OkNERUZHSElKU1RVVldYWVpjZGVmZ2hp
anN0dXZ3eHl6goOEhYaHiImKkpOUlZaXmJmaoqOkpaanqKmqsrO0tba3uLm6wsPE
xcbHyMnK0tPU1dbX2Nna4uPk5ebn6Onq8vP09fb3+Pn6/9oADAMBAAIRAxEAPwCl
Y28YaVehfofStg2qGJAWwAOSRXP2l4DheAz8A9xW01w3kZVsFMZrfoc7uYeqxiW6
SIkDNZV7IqM2eFAwMVpJJ9pupJ2XcEJ6msO+nWZtoUg7j3rGRrFW0LOko3no4GVJ
wRXr/hCwWGDeVyAc15r4Jw0s0ckRJfaI/wCte9+HdNjSwxtG0jFdFGF1dGFWXKZ0
MaTXDSKcsGxSatqSWkDAMMdCKtzxJZuzgY2nOa8z8X+JY/tLhSR7LXROfIjCEXMT
VL7zp85Gdx4qtcyRx2xbcAD2xXLSatvuTluAcjb1q9qOpFkiVOCcY+tcClc7VGx0
Hh+xhu70M4faO7Ct7WrSL7KsS9WPasPSgbSzUscu3XntSX+voLiFGPygY3elaKVl
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','cust2');
INSERT INTO businessobject(id, botype) VALUES ('pic3', 'edu.byu.isys413.data.Picture');
INSERT INTO picture(id, caption, picture , custid) VALUES ('pic3','Meow','/9j/4AAQSkZJRgABAQEAYABgAAD/2wBDAAMCAgMCAgMDAwMEAwMEBQgFBQQEBQoH
BwYIDAoMDAsKCwsNDhIQDQ4RDgsLEBYQERMUFRUVDA8XGBYUGBIUFRT/2wBDAQME
BAUEBQkFBQkUDQsNFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQU
FBQUFBQUFBQUFBQUFBT/wAARCAEVAW0DASIAAhEBAxEB/8QAHwAAAQUBAQEBAQEA
AAAAAAAAAAECAwQFBgcICQoL/8QAtRAAAgEDAwIEAwUFBAQAAAF9AQIDAAQRBRIh
MUEGE1FhByJxFDKBkaEII0KxwRVS0fAkM2JyggkKFhcYGRolJicoKSo0NTY3ODk6
Q0RFRkdISUpTVFVWV1hZWmNkZWZnaGlqc3R1dnd4eXqDhIWGh4iJipKTlJWWl5iZ
mqKjpKWmp6ipqrKztLW2t7i5usLDxMXGx8jJytLT1NXW19jZ2uHi4+Tl5ufo6erx
8vP09fb3+Pn6/8QAHwEAAwEBAQEBAQEBAQAAAAAAAAECAwQFBgcICQoL/8QAtREA
AgECBAQDBAcFBAQAAQJ3AAECAxEEBSExBhJBUQdhcRMiMoEIFEKRobHBCSMzUvAV
YnLRChYkNOEl8RcYGRomJygpKjU2Nzg5OkNERUZHSElKU1RVVldYWVpjZGVmZ2hp
anN0dXZ3eHl6goOEhYaHiImKkpOUlZaXmJmaoqOkpaanqKmqsrO0tba3uLm6wsPE
xcbHyMnK0tPU1dbX2Nna4uPk5ebn6Onq8vP09fb3+Pn6/9oADAMBAAIRAxEAPwCl
Y28YaVehfofStg2qGJAWwAOSRXP2l4DheAz8A9xW01w3kZVsFMZrfoc7uYeqxiW6
SIkDNZV7IqM2eFAwMVpJJ9pupJ2XcEJ6msO+nWZtoUg7j3rGRrFW0LOko3no4GVJ
wRXr/hCwWGDeVyAc15r4Jw0s0ckRJfaI/wCte9+HdNjSwxtG0jFdFGF1dGFWXKZ0
MaTXDSKcsGxSatqSWkDAMMdCKtzxJZuzgY2nOa8z8X+JY/tLhSR7LXROfIjCEXMT
VL7zp85Gdx4qtcyRx2xbcAD2xXLSatvuTluAcjb1q9qOpFkiVOCcY+tcClc7VGx0
Hh+xhu70M4faO7Ct7WrSL7KsS9WPasPSgbSzUscu3XntSX+voLiFGPygY3elaKVl
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','cust3');
INSERT INTO businessobject(id, botype) VALUES ('pic4', 'edu.byu.isys413.data.Picture');
INSERT INTO picture(id, caption, picture , custid) VALUES ('pic4','Meow','/9j/4AAQSkZJRgABAQEAYABgAAD/2wBDAAMCAgMCAgMDAwMEAwMEBQgFBQQEBQoH
BwYIDAoMDAsKCwsNDhIQDQ4RDgsLEBYQERMUFRUVDA8XGBYUGBIUFRT/2wBDAQME
BAUEBQkFBQkUDQsNFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQU
FBQUFBQUFBQUFBQUFBT/wAARCAEVAW0DASIAAhEBAxEB/8QAHwAAAQUBAQEBAQEA
AAAAAAAAAAECAwQFBgcICQoL/8QAtRAAAgEDAwIEAwUFBAQAAAF9AQIDAAQRBRIh
MUEGE1FhByJxFDKBkaEII0KxwRVS0fAkM2JyggkKFhcYGRolJicoKSo0NTY3ODk6
Q0RFRkdISUpTVFVWV1hZWmNkZWZnaGlqc3R1dnd4eXqDhIWGh4iJipKTlJWWl5iZ
mqKjpKWmp6ipqrKztLW2t7i5usLDxMXGx8jJytLT1NXW19jZ2uHi4+Tl5ufo6erx
8vP09fb3+Pn6/8QAHwEAAwEBAQEBAQEBAQAAAAAAAAECAwQFBgcICQoL/8QAtREA
AgECBAQDBAcFBAQAAQJ3AAECAxEEBSExBhJBUQdhcRMiMoEIFEKRobHBCSMzUvAV
YnLRChYkNOEl8RcYGRomJygpKjU2Nzg5OkNERUZHSElKU1RVVldYWVpjZGVmZ2hp
anN0dXZ3eHl6goOEhYaHiImKkpOUlZaXmJmaoqOkpaanqKmqsrO0tba3uLm6wsPE
xcbHyMnK0tPU1dbX2Nna4uPk5ebn6Onq8vP09fb3+Pn6/9oADAMBAAIRAxEAPwCl
Y28YaVehfofStg2qGJAWwAOSRXP2l4DheAz8A9xW01w3kZVsFMZrfoc7uYeqxiW6
SIkDNZV7IqM2eFAwMVpJJ9pupJ2XcEJ6msO+nWZtoUg7j3rGRrFW0LOko3no4GVJ
wRXr/hCwWGDeVyAc15r4Jw0s0ckRJfaI/wCte9+HdNjSwxtG0jFdFGF1dGFWXKZ0
MaTXDSKcsGxSatqSWkDAMMdCKtzxJZuzgY2nOa8z8X+JY/tLhSR7LXROfIjCEXMT
VL7zp85Gdx4qtcyRx2xbcAD2xXLSatvuTluAcjb1q9qOpFkiVOCcY+tcClc7VGx0
Hh+xhu70M4faO7Ct7WrSL7KsS9WPasPSgbSzUscu3XntSX+voLiFGPygY3elaKVl
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','cust4');



-- Print TABLE;
CREATE TABLE print (
  id             VARCHAR(40) PRIMARY KEY REFERENCES businessobject(id),
  price          DECIMAL(8,2),
  size           VARCHAR(100),
  printtype      VARCHAR(100)
);
INSERT INTO businessobject(id, botype) VALUES('printid1', 'edu.byu.isys413.data.Print');
INSERT INTO print(id, price, size, printtype) VALUES('printid1', 0.85, '3x5', 'Mobile');
INSERT INTO businessobject(id, botype) VALUES('printid2', 'edu.byu.isys413.data.Print');
INSERT INTO print(id, price, size, printtype) VALUES('printid2', 1.35, '8.5x11', 'Large');
INSERT INTO businessobject(id, botype) VALUES('printid3', 'edu.byu.isys413.data.Print');
INSERT INTO print(id, price, size, printtype) VALUES('printid3', 5.15, '13x19', 'Poster');

-- Print Order TABLE;
CREATE TABLE printorder(
  id             VARCHAR(40) PRIMARY KEY REFERENCES revenuesource(id),
  quantity       INT,
  printid        VARCHAR(40) REFERENCES print(id),
  pictureid      VARCHAR(40) REFERENCES picture(id)
);

-- Transaction TABLE;
CREATE TABLE transaction (
  id             VARCHAR(40) PRIMARY KEY REFERENCES businessobject(id),
  txdate         DATE,
  subtotal       DOUBLE,
  tax            DOUBLE,
  total          DOUBLE,
  custid         VARCHAR(40) REFERENCES customer(id),
  storeid        VARCHAR(40) REFERENCES store(id),
  empid          VARCHAR(40) REFERENCES employee(id),
  commissionid   VARCHAR(40) REFERENCES commission(id),
  paymentid      VARCHAR(40) REFERENCES payment(id),
  jeid 			 VARCHAR(40) REFERENCES journalentry(id)
);

INSERT INTO businessobject(id, botype) VALUES ('txid1', 'edu.byu.isys413.data.Transaction');
INSERT INTO transaction(id, txdate, subtotal, tax, total, custid, storeid, empid, commissionid, paymentid, jeid) VALUES ('txid1', '2013-01-01', 90, 11, 101, 'cust1', 'store1', 'empid1', 'commissionid1', 'paymentid1', 'journalentryid1');
INSERT INTO businessobject(id, botype) VALUES ('txid2', 'edu.byu.isys413.data.Transaction');
INSERT INTO transaction(id, txdate, subtotal, tax, total, custid, storeid, empid, commissionid, paymentid, jeid) VALUES ('txid2', '2013-01-02', 90, 12, 102, 'cust2', 'store4', 'empid2', 'commissionid2', 'paymentid2', 'journalentryid2');
INSERT INTO businessobject(id, botype) VALUES ('txid3', 'edu.byu.isys413.data.Transaction');
INSERT INTO transaction(id, txdate, subtotal, tax, total, custid, storeid, empid, commissionid, paymentid, jeid) VALUES ('txid3', '2013-01-03', 90, 13, 103, 'cust3', 'store3', 'empid3', 'commissionid3', 'paymentid3', 'journalentryid3');
INSERT INTO businessobject(id, botype) VALUES ('txid4', 'edu.byu.isys413.data.Transaction');
INSERT INTO transaction(id, txdate, subtotal, tax, total, custid, storeid, empid, commissionid, paymentid, jeid) VALUES ('txid4', '2013-01-04', 90, 14, 104, 'cust4', 'store2', 'empid4', 'commissionid4', 'paymentid4', 'journalentryid4');


-- Revenue Source TABLE;
CREATE TABLE revenuesource (
  id            VARCHAR(40) PRIMARY KEY REFERENCES businessobject(id),
  chargeamt     DOUBLE,
  rstype        VARCHAR(40),
  txid			VARCHAR(40) REFERENCES transactioin(id)
);


-- Product TABLE;
CREATE TABLE product (
  id           VARCHAR(40) PRIMARY KEY REFERENCES businessobject(id),
  price        DECIMAL(8,2),
  ptype  	   VARCHAR(40)
);


-- Conceptual Product TABLE;
CREATE TABLE conceptualproduct (
  id           	VARCHAR(40) PRIMARY KEY REFERENCES product(id),
  name         	VARCHAR(250),
  description  	VARCHAR(300),
  manufacturer  VARCHAR(250),
  avgcost       DECIMAL(8,2),
  commrate      DECIMAL(4,2),
  sku           VARCHAR(40),
  cptype        VARCHAR(40)
);


INSERT INTO businessobject(id, botype) VALUES ('conprodid1', 'edu.byu.isys413.data.ConceptualProduct');
INSERT INTO conceptualproduct(id, name, description, manufacturer, avgcost, commrate, sku, cptype) VALUES ('conprodid1', 'Canon Powershot Camera', 'Compact digital camera', 'Canon', 65.00, 0.01, 'pshot', 'Physical');
INSERT INTO product(id, price, ptype) VALUES ('conprodid1', 65.00, 'Conceptual');
INSERT INTO businessobject(id, botype) VALUES ('conprodid2', 'edu.byu.isys413.data.ConceptualProduct');
INSERT INTO product(id, price, ptype) VALUES ('conprodid2', 599.00, 'Conceptual');
INSERT INTO conceptualproduct(id, name, description, manufacturer, avgcost, commrate, sku, cptype) VALUES ('conprodid2', 'Nikkon D3200', '24.2 Mega Pixel Camera', 'Nikkon', 599.00, 0.04, 'nikkon', 'Physical');
INSERT INTO businessobject(id, botype) VALUES ('conprodid3', 'edu.byu.isys413.data.ConceptualProduct');
INSERT INTO product(id, price, ptype) VALUES ('conprodid3', 399.00, 'Conceptual');
INSERT INTO conceptualproduct(id, name, description, manufacturer, avgcost, commrate, sku, cptype) VALUES ('conprodid3', 'GoPro HERO3', 'Waterproof, high def', 'GoPro', 399.00, 0.03, 'gopro', 'Physical');
INSERT INTO businessobject(id, botype) VALUES ('conprodid4', 'edu.byu.isys413.data.ConceptualProduct');
INSERT INTO product(id, price, ptype) VALUES ('conprodid4', 339.00, 'Conceptual');
INSERT INTO conceptualproduct(id, name, description, manufacturer, avgcost, commrate, sku, cptype) VALUES ('conprodid4', 'Canon EF 55mm Lens', 'Lightweight, fast apeture adjustment', 'Canon', 339.00, 0.04, 'lens', 'Physical');


INSERT INTO businessobject(id, botype) VALUES ('cpid1', 'edu.byu.isys413.data.ConceptualProduct');
INSERT INTO product(id, price, ptype) VALUES ('cpid1', 4.59, 'Conceptual');
INSERT INTO conceptualproduct(id, name, description, manufacturer, avgcost, commrate, sku, cptype) VALUES ('cpid1', 'Kodak Disposable Camera', 'Take 30 pictures and then drop off entire camera to develop', 'Kodak', 1.00, 0.01, 'dcamera', 'Conceptual');

INSERT INTO businessobject(id, botype) VALUES ('cpid2', 'edu.byu.isys413.data.ConceptualProduct');
INSERT INTO product(id, price, ptype) VALUES ('cpid2', 2.50, 'Conceptual');
INSERT INTO conceptualproduct(id, name, description, manufacturer, avgcost, commrate, sku, cptype) VALUES ('cpid2', 'Fuji Film Cannister', 'Film roll, 30 pictures total', 'Fuji', 2.50, 0.02, 'film', 'Conceptual');

INSERT INTO businessobject(id, botype) VALUES ('cpid3', 'edu.byu.isys413.data.ConceptualProduct');
INSERT INTO product(id, price, ptype) VALUES ('cpid3', 14.99, 'Conceptual');
INSERT INTO conceptualproduct(id, name, description, manufacturer, avgcost, commrate, sku, cptype) VALUES ('cpid3', 'Camera Strap', 'Very comfortable strap', 'CameraCorp', 14.99, 0.03, 'strap', 'Conceptual');

INSERT INTO businessobject(id, botype) VALUES ('cpid4', 'edu.byu.isys413.data.ConceptualProduct');
INSERT INTO product(id, price, ptype) VALUES ('cpid4', 34.99, 'Conceptual');
INSERT INTO conceptualproduct(id, name, description, manufacturer, avgcost, commrate, sku, cptype) VALUES ('cpid4', 'Tripod', 'Has three legs', 'TripodsRUs', 34.99, 0.04, 'tripod', 'Conceptual');


-- Physical Product TABLE;
CREATE TABLE physicalproduct (
  id            VARCHAR(40) PRIMARY KEY REFERENCES product(id),
  conprodid     VARCHAR(40) REFERENCES conceptualproduct(id),
  serialnum     VARCHAR(40),
  shelflocation VARCHAR(100),
  datepurchased DATE,
  status	    VARCHAR(40),
  pptype        VARCHAR(40),
  commrate      DECIMAL(2,2),
  cost          DECIMAL(8,2),
  storeid       VARCHAR(40)
);


-- For Rent TABLE;
CREATE TABLE forrent (
  id           VARCHAR(40) PRIMARY KEY REFERENCES businessobject(id),
  timesrented  INT
);

INSERT INTO businessobject(id, botype) VALUES ('forrentid1', 'edu.byu.isys413.data.ForRent');
INSERT INTO product(id, price, ptype) VALUES ('forrentid1', 1, 'Physical');
INSERT INTO physicalproduct(id, conprodid, serialnum, shelflocation, datepurchased, status, commrate, cost, ppType, storeid) VALUES ('forrentid1', 'conrentid1', 'rent1','shelf 1', '2013-01-01', 'status1', 0.01, 10, 'ForRent','store1');
INSERT INTO forrent(id, timesrented) VALUES ('forrentid1', 1);
INSERT INTO businessobject(id, botype) VALUES ('forrentid2', 'edu.byu.isys413.data.ForRent');
INSERT INTO product(id, price, ptype) VALUES ('forrentid2', 2, 'Physical');
INSERT INTO physicalproduct(id, conprodid, serialnum, shelflocation, datepurchased, status, commrate, cost, ppType, storeid) VALUES ('forrentid2', 'conrentid2', 'serialnumfr2','shelf 2', '2013-01-02', 'status2', 0.02, 20, 'ForRent','store2');
INSERT INTO forrent(id, timesrented) VALUES ('forrentid2', 1);
INSERT INTO businessobject(id, botype) VALUES ('forrentid3', 'edu.byu.isys413.data.ForRent');
INSERT INTO product(id, price, ptype) VALUES ('forrentid3', 3, 'Physical');
INSERT INTO physicalproduct(id, conprodid, serialnum, shelflocation, datepurchased, status, commrate, cost, ppType, storeid) VALUES ('forrentid3', 'conrentid3', 'serialnumfr3','shelf 3', '2013-01-03', 'status3', 0.03, 30, 'ForRent','store3');
INSERT INTO forrent(id, timesrented) VALUES ('forrentid3', 1);
INSERT INTO businessobject(id, botype) VALUES ('forrentid4', 'edu.byu.isys413.data.ForRent');
INSERT INTO product(id, price, ptype) VALUES ('forrentid4', 4, 'Physical');
INSERT INTO physicalproduct(id, conprodid, serialnum, shelflocation, datepurchased, status, commrate, cost, ppType, storeid) VALUES ('forrentid4', 'conrentid4', 'serialnumfr4','shelf 4', '2013-01-04', 'status4', 0.04, 40, 'ForRent','store4');
INSERT INTO forrent(id, timesrented) VALUES ('forrentid4', 1);


-- ForSale TABLE;
CREATE TABLE forsale (
  id           VARCHAR(40) PRIMARY KEY REFERENCES businessobject(id),
  newused      VARCHAR(40)
);
INSERT INTO businessobject(id, botype) VALUES ('forsaleid1', 'edu.byu.isys413.data.ForSale');
INSERT INTO product(id, price, ptype) VALUES ('forsaleid1', 65.00, 'Physical');
INSERT INTO physicalproduct(id, conprodid, serialnum, shelflocation, datepurchased, status, commrate, cost, pptype, storeid) VALUES ('forsaleid1', 'conprodid1', 'pshotserial','shelf 1', '2013-01-01', 'status1', 0.01, 65, 'ForSale', 'store1');
INSERT INTO forsale(id, newused) VALUES('forsaleid1', 'new');
INSERT INTO businessobject(id, botype) VALUES ('forsaleid2', 'edu.byu.isys413.data.ForSale');
INSERT INTO product(id, price, ptype) VALUES ('forsaleid2', 599.00, 'Physical');
INSERT INTO physicalproduct(id, conprodid, serialnum, shelflocation, datepurchased, status, commrate, cost, pptype, storeid) VALUES ('forsaleid2', 'conprodid2', 'nikkonserial','shelf 2', '2013-01-02', 'status2', 0.02, 599.00, 'ForSale', 'store2');
INSERT INTO forsale(id, newused) VALUES('forsaleid2', 'new');
INSERT INTO businessobject(id, botype) VALUES ('forsaleid3', 'edu.byu.isys413.data.ForSale');
INSERT INTO product(id, price, ptype) VALUES ('forsaleid3', 399.00, 'Physical');
INSERT INTO physicalproduct(id, conprodid, serialnum, shelflocation, datepurchased, status, commrate, cost, pptype, storeid) VALUES ('forsaleid3', 'conprodid3', 'goproserial','shelf 3', '2013-01-03', 'status3', 0.03, 399.00, 'ForSale', 'store3');
INSERT INTO forsale(id, newused) VALUES('forsaleid3', 'used');
INSERT INTO businessobject(id, botype) VALUES ('forsaleid4', 'edu.byu.isys413.data.ForSale');
INSERT INTO product(id, price, ptype) VALUES ('forsaleid4', 339.00, 'Physical');
INSERT INTO physicalproduct(id, conprodid, serialnum, shelflocation, datepurchased, status, commrate, cost, pptype, storeid) VALUES ('forsaleid4', 'conprodid4', 'lensserial','shelf 4', '2013-01-04', 'status4', 0.04, 339.00, 'ForSale', 'store4');
INSERT INTO forsale(id, newused) VALUES('forsaleid4', 'used');


-- Store Product TABLE;
CREATE TABLE storeproduct (
  id           VARCHAR(40) PRIMARY KEY REFERENCES businessobject(id),
  conprodid    VARCHAR(40) REFERENCES conceptualproduct(id),
  storeid      VARCHAR(40) REFERENCES store(id),
  quantity     INT,
  location     VARCHAR(100)
);

INSERT INTO businessobject(id, botype) VALUES ('storeprod1', 'edu.byu.isys413.data.StoreProduct');
INSERT INTO storeproduct(id, conprodid, storeid, quantity, location) VALUES ('storeprod1', 'conprodid1', 'store1', 1, 'shelf1');
INSERT INTO businessobject(id, botype) VALUES ('storeprod2', 'edu.byu.isys413.data.StoreProduct');
INSERT INTO storeproduct(id, conprodid, storeid, quantity, location) VALUES ('storeprod2', 'conprodid2', 'store2', 1, 'shelf2');
INSERT INTO businessobject(id, botype) VALUES ('storeprod3', 'edu.byu.isys413.data.StoreProduct');
INSERT INTO storeproduct(id, conprodid, storeid, quantity, location) VALUES ('storeprod3', 'conprodid3', 'store3', 1, 'shelf3');
INSERT INTO businessobject(id, botype) VALUES ('storeprod4', 'edu.byu.isys413.data.StoreProduct');
INSERT INTO storeproduct(id, conprodid, storeid, quantity, location) VALUES ('storeprod4', 'conprodid4', 'store4', 1, 'shelf4');
INSERT INTO businessobject(id, botype) VALUES ('storeprod5', 'edu.byu.isys413.data.StoreProduct');
INSERT INTO storeproduct(id, conprodid, storeid, quantity, location) VALUES ('storeprod5', 'forrentid1', 'store1', 1, 'shelf1');
INSERT INTO businessobject(id, botype) VALUES ('storeprod6', 'edu.byu.isys413.data.StoreProduct');
INSERT INTO storeproduct(id, conprodid, storeid, quantity, location) VALUES ('storeprod6', 'forrentid2', 'store2', 1, 'shelf2');
INSERT INTO businessobject(id, botype) VALUES ('storeprod7', 'edu.byu.isys413.data.StoreProduct');
INSERT INTO storeproduct(id, conprodid, storeid, quantity, location) VALUES ('storeprod7', 'forrentid3', 'store3', 1, 'shelf3');
INSERT INTO businessobject(id, botype) VALUES ('storeprod8', 'edu.byu.isys413.data.StoreProduct');
INSERT INTO storeproduct(id, conprodid, storeid, quantity, location) VALUES ('storeprod8', 'forrentid4', 'store4', 1, 'shelf4');
INSERT INTO businessobject(id, botype) VALUES ('storeprod9', 'edu.byu.isys413.data.StoreProduct');
INSERT INTO storeproduct(id, conprodid, storeid, quantity, location) VALUES ('storeprod9', 'forsaleid1', 'store1', 1, 'shelf1');
INSERT INTO businessobject(id, botype) VALUES ('storeprod10', 'edu.byu.isys413.data.StoreProduct');
INSERT INTO storeproduct(id, conprodid, storeid, quantity, location) VALUES ('storeprod10', 'forsaleid2', 'store2', 1, 'shelf2');
INSERT INTO businessobject(id, botype) VALUES ('storeprod11', 'edu.byu.isys413.data.StoreProduct');
INSERT INTO storeproduct(id, conprodid, storeid, quantity, location) VALUES ('storeprod11', 'forsaleid3', 'store3', 1, 'shelf3');
INSERT INTO businessobject(id, botype) VALUES ('storeprod12', 'edu.byu.isys413.data.StoreProduct');
INSERT INTO storeproduct(id, conprodid, storeid, quantity, location) VALUES ('storeprod12', 'forsaleid4', 'store4', 1, 'shelf4');
INSERT INTO businessobject(id, botype) VALUES ('storeprod13', 'edu.byu.isys413.data.StoreProduct');
INSERT INTO storeproduct(id, conprodid, storeid, quantity, location) VALUES ('storeprod13', 'cpid1', 'store4', 40, 'shelf4');
INSERT INTO businessobject(id, botype) VALUES ('storeprod13a', 'edu.byu.isys413.data.StoreProduct');
INSERT INTO storeproduct(id, conprodid, storeid, quantity, location) VALUES ('storeprod13a', 'cpid1', 'store3', 30, 'shelf4');
INSERT INTO businessobject(id, botype) VALUES ('storeprod13b', 'edu.byu.isys413.data.StoreProduct');
INSERT INTO storeproduct(id, conprodid, storeid, quantity, location) VALUES ('storeprod13b', 'cpid1', 'store2', 25, 'shelf4');
INSERT INTO businessobject(id, botype) VALUES ('storeprod13c', 'edu.byu.isys413.data.StoreProduct');
INSERT INTO storeproduct(id, conprodid, storeid, quantity, location) VALUES ('storeprod13c', 'cpid1', 'store1', 20, 'shelf4');
INSERT INTO businessobject(id, botype) VALUES ('storeprod14', 'edu.byu.isys413.data.StoreProduct');
INSERT INTO storeproduct(id, conprodid, storeid, quantity, location) VALUES ('storeprod14', 'cpid2', 'store1', 15, 'shelf4');
INSERT INTO businessobject(id, botype) VALUES ('storeprod14a', 'edu.byu.isys413.data.StoreProduct');
INSERT INTO storeproduct(id, conprodid, storeid, quantity, location) VALUES ('storeprod14a', 'cpid2', 'store2', 15, 'shelf4');
INSERT INTO businessobject(id, botype) VALUES ('storeprod14b', 'edu.byu.isys413.data.StoreProduct');
INSERT INTO storeproduct(id, conprodid, storeid, quantity, location) VALUES ('storeprod14b', 'cpid2', 'store3', 5, 'shelf4');
INSERT INTO businessobject(id, botype) VALUES ('storeprod14c', 'edu.byu.isys413.data.StoreProduct');
INSERT INTO storeproduct(id, conprodid, storeid, quantity, location) VALUES ('storeprod14c', 'cpid2', 'store4', 25, 'shelf4');
INSERT INTO businessobject(id, botype) VALUES ('storeprod15', 'edu.byu.isys413.data.StoreProduct');
INSERT INTO storeproduct(id, conprodid, storeid, quantity, location) VALUES ('storeprod15', 'cpid3', 'store1', 25, 'shelf4');
INSERT INTO businessobject(id, botype) VALUES ('storeprod15a', 'edu.byu.isys413.data.StoreProduct');
INSERT INTO storeproduct(id, conprodid, storeid, quantity, location) VALUES ('storeprod15a', 'cpid3', 'store2', 25, 'shelf4');
INSERT INTO businessobject(id, botype) VALUES ('storeprod15b', 'edu.byu.isys413.data.StoreProduct');
INSERT INTO storeproduct(id, conprodid, storeid, quantity, location) VALUES ('storeprod15b', 'cpid3', 'store3', 15, 'shelf4');
INSERT INTO businessobject(id, botype) VALUES ('storeprod15c', 'edu.byu.isys413.data.StoreProduct');
INSERT INTO storeproduct(id, conprodid, storeid, quantity, location) VALUES ('storeprod15c', 'cpid3', 'store4', 15, 'shelf4');
INSERT INTO businessobject(id, botype) VALUES ('storeprod16', 'edu.byu.isys413.data.StoreProduct');
INSERT INTO storeproduct(id, conprodid, storeid, quantity, location) VALUES ('storeprod16', 'cpid4', 'store1', 25, 'shelf4');
INSERT INTO businessobject(id, botype) VALUES ('storeprod16a', 'edu.byu.isys413.data.StoreProduct');
INSERT INTO storeproduct(id, conprodid, storeid, quantity, location) VALUES ('storeprod16a', 'cpid4', 'store2', 25, 'shelf4');
INSERT INTO businessobject(id, botype) VALUES ('storeprod16b', 'edu.byu.isys413.data.StoreProduct');
INSERT INTO storeproduct(id, conprodid, storeid, quantity, location) VALUES ('storeprod16b', 'cpid4', 'store3', 25, 'shelf4');
INSERT INTO businessobject(id, botype) VALUES ('storeprod16c', 'edu.byu.isys413.data.StoreProduct');
INSERT INTO storeproduct(id, conprodid, storeid, quantity, location) VALUES ('storeprod16c', 'cpid4', 'store4', 25, 'shelf4');


-- Sale TABLE;
CREATE TABLE sale (
  id         VARCHAR(40) PRIMARY KEY REFERENCES businessobject(id),
  quantity   INT,
  prodid     VARCHAR(40) REFERENCES product(id),
  saletype   VARCHAR(40),
  indb       BOOLEAN,
  dirty      BOOLEAN
);


-- In Store TABLE;
CREATE TABLE instore(
	id         VARCHAR(40) PRIMARY KEY REFERENCES sale(id)
);
INSERT INTO businessobject(id, botype) VALUES ('instoreid1', 'edu.byu.isys413.data.InStore');
INSERT INTO revenuesource(id, chargeamt, rstype, txid) VALUES ('instoreid1', 1, 'Sale', 'txid1');
INSERT INTO sale(id, quantity, prodid, saletype) VALUES ('instoreid1', 1, 'forsaleid1', 'InStore');
INSERT INTO instore(id) VALUES ('instoreid1');
INSERT INTO businessobject(id, botype) VALUES ('instoreid2', 'edu.byu.isys413.data.InStore');
INSERT INTO revenuesource(id, chargeamt, rstype, txid) VALUES ('instoreid2', 1, 'Sale', 'txid1');
INSERT INTO sale(id, quantity, prodid, saletype) VALUES ('instoreid2', 2, 'forsaleid2', 'InStore');
INSERT INTO instore(id) VALUES ('instoreid2');
INSERT INTO businessobject(id, botype) VALUES ('instoreid3', 'edu.byu.isys413.data.InStore');
INSERT INTO revenuesource(id, chargeamt, rstype, txid) VALUES ('instoreid3', 1, 'Sale', 'txid1');
INSERT INTO sale(id, quantity, prodid, saletype) VALUES ('instoreid3', 3, 'conprodid3', 'InStore');
INSERT INTO instore(id) VALUES ('instoreid3');
INSERT INTO businessobject(id, botype) VALUES ('instoreid4', 'edu.byu.isys413.data.InStore');
INSERT INTO revenuesource(id, chargeamt, rstype, txid) VALUES ('instoreid4', 1, 'Sale', 'txid1');
INSERT INTO sale(id, quantity, prodid, saletype) VALUES ('instoreid4', 4, 'conprodid2', 'InStore');
INSERT INTO instore(id) VALUES ('instoreid4');


-- Online TABLE;
CREATE TABLE online(
	id         VARCHAR(40) PRIMARY KEY REFERENCES sale(id),	
    pickup     BOOLEAN
);

INSERT INTO businessobject(id, botype) VALUES ('onlineid1', 'edu.byu.isys413.data.Online');
INSERT INTO revenuesource(id, chargeamt, rstype, txid) VALUES ('onlineid1', 1, 'Sale', 'txid2');
INSERT INTO sale(id, quantity, prodid) VALUES ('onlineid1', 1, 'forsaleid3');
INSERT INTO online(id, pickup) VALUES('onlineid1', true);
INSERT INTO businessobject(id, botype) VALUES ('onlineid2', 'edu.byu.isys413.data.Online');
INSERT INTO revenuesource(id, chargeamt, rstype, txid) VALUES ('onlineid2', 1, 'Sale', 'txid2');
INSERT INTO sale(id, quantity, prodid) VALUES ('onlineid2', 2, 'forsaleid4');
INSERT INTO online(id, pickup) VALUES('onlineid2', true);
INSERT INTO businessobject(id, botype) VALUES ('onlineid3', 'edu.byu.isys413.data.Online');
INSERT INTO revenuesource(id, chargeamt, rstype, txid) VALUES ('onlineid3', 1, 'Sale', 'txid2');
INSERT INTO sale(id, quantity, prodid) VALUES ('onlineid3', 3, 'conprodid3');
INSERT INTO online(id, pickup) VALUES('onlineid3', false);
INSERT INTO businessobject(id, botype) VALUES ('onlineid4', 'edu.byu.isys413.data.Online');
INSERT INTO revenuesource(id, chargeamt, rstype, txid) VALUES ('onlineid4', 1, 'Sale', 'txid2');
INSERT INTO sale(id, quantity, prodid) VALUES ('onlineid4', 4, 'conprodid4');
INSERT INTO online(id, pickup) VALUES('onlineid4', false);


-- Rental TABLE;
CREATE TABLE rental (
  id           VARCHAR(40) PRIMARY KEY REFERENCES businessobject(id),
  dateout      DATE,
  datein       DATE,
  datedue      DATE,
  remindersent BOOLEAN,
  forrentid    VARCHAR(40) REFERENCES forrent(id)
);

INSERT INTO businessobject(id, botype) VALUES ('rentid1', 'edu.byu.isys413.data.Rental');
INSERT INTO revenuesource(id, chargeamt, rstype, txid) VALUES ('rentid1', 1, 'Rental', 'txid1');
INSERT INTO rental(id, dateout, datedue, remindersent, forrentid) VALUES ('rentid1', '2013-01-01', '2013-01-02', false, 'forrentid1');
INSERT INTO businessobject(id, botype) VALUES ('rentid2', 'edu.byu.isys413.data.Rental');
INSERT INTO revenuesource(id, chargeamt, rstype, txid) VALUES ('rentid2', 2, 'Rental', 'txid1');
INSERT INTO rental(id, dateout, datedue, remindersent, forrentid) VALUES ('rentid2', '2013-01-01', '2013-01-02', false, 'forrentid2');
INSERT INTO businessobject(id, botype) VALUES ('rentid3', 'edu.byu.isys413.data.Rental');
INSERT INTO revenuesource(id, chargeamt, rstype, txid) VALUES ('rentid3', 3, 'Rental', 'txid2');
INSERT INTO rental(id, dateout, datedue, remindersent, forrentid) VALUES ('rentid3', '2013-01-01', '2013-01-02', false, 'forrentid3');
INSERT INTO businessobject(id, botype) VALUES ('rentid4', 'edu.byu.isys413.data.Rental');
INSERT INTO revenuesource(id, chargeamt, rstype, txid) VALUES ('rentid4', 4, 'Rental', 'txid2');
INSERT INTO rental(id, dateout, datedue, remindersent, forrentid) VALUES ('rentid4', '2013-01-01', '2013-01-02', false, 'forrentid4');


-- Fee Table;
CREATE TABLE fee (
  id		   VARCHAR(40) PRIMARY KEY REFERENCES businessobject(id),
  rentalid     VARCHAR(40) REFERENCES rental(id),
  empid        VARCHAR(40) REFERENCES employee(id),
  feetype      VARCHAR(40),
  amount       DECIMAL(8,2),
  waived       BOOLEAN
);


-- Late Table;
CREATE TABLE late (
  id           VARCHAR(40) PRIMARY KEY REFERENCES fee(id),
  dayslate     INT
);

INSERT INTO businessobject(id, botype) VALUES ('lateid1', 'edu.byu.isys413.data.Late');
INSERT INTO revenuesource(id, chargeamt, rstype, txid) VALUES ('lateid1', 1, 'Fee', 'txid1');
INSERT INTO late(id, dayslate) VALUES ('lateid1', 1);
INSERT INTO businessobject(id, botype) VALUES ('lateid2', 'edu.byu.isys413.data.Late');
INSERT INTO revenuesource(id, chargeamt, rstype, txid) VALUES ('lateid2', 2, 'Fee', 'txid1');
INSERT INTO late(id, dayslate) VALUES ('lateid2', 2);
INSERT INTO businessobject(id, botype) VALUES ('lateid3', 'edu.byu.isys413.data.Late');
INSERT INTO revenuesource(id, chargeamt, rstype, txid) VALUES ('lateid3', 3, 'Fee', 'txid2');
INSERT INTO late(id, dayslate) VALUES ('lateid3', 3);
INSERT INTO businessobject(id, botype) VALUES ('lateid4', 'edu.byu.isys413.data.Late');
INSERT INTO revenuesource(id, chargeamt, rstype, txid) VALUES ('lateid4', 4, 'Fee', 'txid2');
INSERT INTO late(id, dayslate) VALUES ('lateid4', 4);


-- Damage Table;
CREATE TABLE damage(
  id           VARCHAR(40) PRIMARY KEY REFERENCES fee(id),
  description  VARCHAR(250)
);

INSERT INTO businessobject(id, botype) VALUES ('damid1', 'edu.byu.isys413.data.Damage');
INSERT INTO revenuesource(id, chargeamt, rstype, txid) VALUES ('damid1', 1, 'Fee', 'txid3');
INSERT INTO damage(id, description) VALUES ('damid1', 'broken');
INSERT INTO businessobject(id, botype) VALUES ('damid2', 'edu.byu.isys413.data.Damage');
INSERT INTO revenuesource(id, chargeamt, rstype, txid) VALUES ('damid2', 2, 'Fee', 'txid3');
INSERT INTO damage(id, description) VALUES ('damid2', 'broken');
INSERT INTO businessobject(id, botype) VALUES ('damid3', 'edu.byu.isys413.data.Damage');
INSERT INTO revenuesource(id, chargeamt, rstype, txid) VALUES ('damid3', 3, 'Fee', 'txid4');
INSERT INTO damage(id, description) VALUES ('damid3', 'broken');
INSERT INTO businessobject(id, botype) VALUES ('damid4', 'edu.byu.isys413.data.Damage');
INSERT INTO revenuesource(id, chargeamt, rstype, txid) VALUES ('damid4', 4, 'Fee', 'txid4');
INSERT INTO damage(id, description) VALUES ('damid4', 'broken');


-- Conceptual Rental TABLE;
CREATE TABLE conceptualrental (
  id                VARCHAR(40) PRIMARY KEY REFERENCES businessobject(id),
  priceperday       DECIMAL(8,2),
  replacementprice  DECIMAL(8,2),
  indb              BOOLEAN,
  dirty             BOOLEAN
);

INSERT INTO businessobject(id, botype) VALUES ('conrentid1', 'edu.byu.isys413.data.ConceptualRental');
INSERT INTO product(id, price, ptype) VALUES ('conrentid1', 1, 'Conceptual');
INSERT INTO conceptualproduct(id, name, description, manufacturer, avgcost, commrate, sku, cptype) VALUES ('conrentid1', 'Nikkon D55 F-series', 'Perfect for rentals', 'Nikkon', 1.00, 0.01, 'nikkonrent', 'ConceptualRental');
INSERT INTO conceptualrental(id, priceperday, replacementprice) VALUES ('conrentid1', 1, 10);
INSERT INTO businessobject(id, botype) VALUES ('conrentid2', 'edu.byu.isys413.data.ConceptualRental');
INSERT INTO product(id, price, ptype) VALUES ('conrentid2', 2, 'Conceptual');
INSERT INTO conceptualproduct(id, name, description, manufacturer, avgcost, commrate, sku, cptype) VALUES ('conrentid2', 'Canon Powershot Digital', 'Perfect for rentals', 'Canon', 2.00, 0.02, 'canonrent', 'ConceptualRental');
INSERT INTO conceptualrental(id, priceperday, replacementprice) VALUES ('conrentid2', 2, 20);
INSERT INTO businessobject(id, botype) VALUES ('conrentid3', 'edu.byu.isys413.data.ConceptualRental');
INSERT INTO product(id, price, ptype) VALUES ('conrentid3', 3, 'Conceptual');
INSERT INTO conceptualproduct(id, name, description, manufacturer, avgcost, commrate, sku, cptype) VALUES ('conrentid3', 'Heavy Duty Tripod', 'Tough tripod for rentals', 'TripodsRUs', 3.00, 0.03, 'tripodrent', 'ConceptualRental');
INSERT INTO conceptualrental(id, priceperday, replacementprice) VALUES ('conrentid3', 3, 30);
INSERT INTO businessobject(id, botype) VALUES ('conrentid4', 'edu.byu.isys413.data.ConceptualRental');
INSERT INTO product(id, price, ptype) VALUES ('conrentid4', 4, 'Conceptual');
INSERT INTO conceptualproduct(id, name, description, manufacturer, avgcost, commrate, sku, cptype) VALUES ('conrentid4', 'Cannon M5 Lens', '5mm, perfect for rentals', 'Canon', 4.00, 0.04, 'lensrent', 'ConceptualRental');
INSERT INTO conceptualrental(id, priceperday, replacementprice) VALUES ('conrentid4', 4, 40);

-- Membership Table;
CREATE TABLE membership(
	id              VARCHAR(40) PRIMARY KEY REFERENCES businessobject(id),
	creditcard      VARCHAR(40),
	expiredate      VARCHAR(40),
	trialmembership BOOLEAN,
	custid          VARCHAR(40)
);
INSERT INTO businessobject(id, botype) VALUES ('memid1', 'edu.byu.isys413.data.Membership');
INSERT INTO membership(id, creditcard, expiredate, custid) VALUES ('memid1', '123456789', '12/15', 'cust1');
INSERT INTO businessobject(id, botype) VALUES ('memid2', 'edu.byu.isys413.data.Membership');
INSERT INTO membership(id, creditcard, expiredate, custid) VALUES ('memid2', '123456789', '04/16', 'cust2');
INSERT INTO businessobject(id, botype) VALUES ('memid3', 'edu.byu.isys413.data.Membership');
INSERT INTO membership(id, creditcard, expiredate, custid) VALUES ('memid3', '123456789', '05/17', 'cust3');
INSERT INTO businessobject(id, botype) VALUES ('memid4', 'edu.byu.isys413.data.Membership');
INSERT INTO membership(id, creditcard, expiredate, custid) VALUES ('memid4', '123456789', '09/13', 'cust4');

-- General Ledger TABLE;
CREATE TABLE generalledger(
  id         VARCHAR(40) PRIMARY KEY REFERENCES businessobject(id),
  name       VARCHAR(250),
  balance    DECIMAL(8,2),
  gltype     VARCHAR(40),
  indb       BOOLEAN,
  dirty      BOOLEAN
);
  
INSERT INTO businessobject(id, botype) VALUES ('glid1', 'edu.byu.isys413.data.GeneralLedger');
INSERT INTO generalledger(id, name, balance, gltype) VALUES ('glid1', 'Cash', 0, 'Debit');
INSERT INTO businessobject(id, botype) VALUES ('glid2', 'edu.byu.isys413.data.GeneralLedger');
INSERT INTO generalledger(id, name, balance, gltype) VALUES ('glid2', 'Sales Revenue', 0, 'Credit');
INSERT INTO businessobject(id, botype) VALUES ('glid3a', 'edu.byu.isys413.data.GeneralLedger');
INSERT INTO generalledger(id, name, balance, gltype) VALUES ('glid3a', 'Fee Revenue', 0, 'Credit');
INSERT INTO businessobject(id, botype) VALUES ('glid3b', 'edu.byu.isys413.data.GeneralLedger');
INSERT INTO generalledger(id, name, balance, gltype) VALUES ('glid3b', 'Rental Revenue', 0, 'Credit');
INSERT INTO businessobject(id, botype) VALUES ('glid3', 'edu.byu.isys413.data.GeneralLedger');
INSERT INTO generalledger(id, name, balance, gltype) VALUES ('glid3', 'Tax Payable', 0, 'Credit');
INSERT INTO businessobject(id, botype) VALUES ('glid4', 'edu.byu.isys413.data.GeneralLedger');
INSERT INTO generalledger(id, name, balance, gltype) VALUES ('glid4', 'Commission Expense', 0, 'Debit');
INSERT INTO businessobject(id, botype) VALUES ('glid5', 'edu.byu.isys413.data.GeneralLedger');
INSERT INTO generalledger(id, name, balance, gltype) VALUES ('glid5', 'Commission Payable', 0, 'Credit');
