-- Table: movies

-- DROP TABLE movies;

CREATE TABLE movies
(
  movieid integer NOT NULL,
  imdbid integer,
  title character varying(64),
  "year" integer,
  CONSTRAINT pkey PRIMARY KEY (movieid)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE movies OWNER TO jake;