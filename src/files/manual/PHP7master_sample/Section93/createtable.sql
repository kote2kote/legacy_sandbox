DROP TABLE IF EXISTS zipcode;
CREATE TABLE zipcode (
    jiscode         VARCHAR(255),
    postcode_short  VARCHAR(255),
    postcode        VARCHAR(255),
    pref_kana       TEXT,
    city_kana       TEXT,
    town_kana       TEXT,
    pref_kanji      TEXT,
    city_kanji      TEXT,
    town_kanji      TEXT,
    flag1           TINYINT,
    flag2           TINYINT,
    flag3           TINYINT,
    flag4           TINYINT,
    flag5           TINYINT,
    flag6           TINYINT
);
