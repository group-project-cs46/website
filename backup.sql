--
-- PostgreSQL database dump
--

-- Dumped from database version 15.8
-- Dumped by pg_dump version 17.4 (Homebrew)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: public; Type: SCHEMA; Schema: -; Owner: -
--

CREATE SCHEMA public;


--
-- Name: SCHEMA public; Type: COMMENT; Schema: -; Owner: -
--

COMMENT ON SCHEMA public IS 'standard public schema';


--
-- Name: complaint_status; Type: TYPE; Schema: public; Owner: -
--

CREATE TYPE public.complaint_status AS ENUM (
    'pending',
    'in review',
    'resolved',
    'rejected'
);


--
-- Name: course_enum; Type: TYPE; Schema: public; Owner: -
--

CREATE TYPE public.course_enum AS ENUM (
    'computer science',
    'information systems'
);


--
-- Name: round_status; Type: TYPE; Schema: public; Owner: -
--

CREATE TYPE public.round_status AS ENUM (
    'enabled',
    'disabled'
);


--
-- Name: visit_status; Type: TYPE; Schema: public; Owner: -
--

CREATE TYPE public.visit_status AS ENUM (
    'pending',
    'visited',
    'not visited'
);


--
-- Name: prevent_multiple_selected(); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.prevent_multiple_selected() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
BEGIN
    -- Check if there is already a record with selected = true for the same student_id
    IF NEW.selected = true AND EXISTS (
        SELECT 1
        FROM applications
        WHERE student_id = NEW.student_id
        AND selected = true
    ) THEN
        RAISE EXCEPTION 'A record with selected = true already exists for student_id %', NEW.student_id;
    END IF;
    RETURN NEW;
END;
$$;


SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: admins; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.admins (
    id integer NOT NULL,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


--
-- Name: admins_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.admins_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: admins_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.admins_id_seq OWNED BY public.admins.id;


--
-- Name: advertisements; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.advertisements (
    id integer NOT NULL,
    pdc_id integer,
    max_cvs integer,
    responsibilities character varying(255) NOT NULL,
    qualifications_skills character varying(255),
    deadline date,
    vacancy_count integer,
    company_id integer,
    batch_id integer,
    internship_role_id integer,
    approved boolean,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    photo_id integer
);


--
-- Name: ads_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.ads_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: ads_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.ads_id_seq OWNED BY public.advertisements.id;


--
-- Name: advertisements_qualifications; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.advertisements_qualifications (
    advertisement_id integer NOT NULL,
    qualification_id integer NOT NULL,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


--
-- Name: ads_qualifications_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.ads_qualifications_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: ads_qualifications_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.ads_qualifications_id_seq OWNED BY public.advertisements_qualifications.advertisement_id;


--
-- Name: applications; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.applications (
    id integer NOT NULL,
    student_id integer,
    cv_id real,
    ad_id integer,
    interview_id integer,
    selected boolean,
    failed boolean,
    shortlisted boolean,
    is_second_round boolean,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


--
-- Name: applications_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.applications_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: applications_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.applications_id_seq OWNED BY public.applications.id;


--
-- Name: batches; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.batches (
    id integer NOT NULL,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    first_round_start_time timestamp without time zone,
    second_round_start_time timestamp without time zone,
    description text,
    first_round_end_time timestamp without time zone,
    second_round_end_time timestamp without time zone
);


--
-- Name: batches_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

ALTER TABLE public.batches ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.batches_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- Name: blacklist_reasons; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.blacklist_reasons (
    id integer NOT NULL,
    company_id integer NOT NULL,
    reason text NOT NULL
);


--
-- Name: blacklist_reasons_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.blacklist_reasons_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: blacklist_reasons_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.blacklist_reasons_id_seq OWNED BY public.blacklist_reasons.id;


--
-- Name: companies; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.companies (
    id integer NOT NULL,
    website character varying(255),
    building character varying(255),
    street_name character varying(255),
    city character varying(255),
    postal_code character varying(255),
    address_line_2 character varying(255),
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


--
-- Name: companies_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.companies_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: companies_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.companies_id_seq OWNED BY public.companies.id;


--
-- Name: complaint_messages; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.complaint_messages (
    id integer NOT NULL,
    complaint_id integer NOT NULL,
    sender_id integer NOT NULL,
    message text NOT NULL,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


--
-- Name: complaint_messages_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

ALTER TABLE public.complaint_messages ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.complaint_messages_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- Name: complaints; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.complaints (
    id integer NOT NULL,
    complainant_id integer NOT NULL,
    accused_id integer NOT NULL,
    subject character varying(255) NOT NULL,
    description text NOT NULL,
    status public.complaint_status DEFAULT 'pending'::public.complaint_status,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    complaint_type character varying
);


--
-- Name: complaints_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.complaints_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: complaints_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.complaints_id_seq OWNED BY public.complaints.id;


--
-- Name: cvs; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.cvs (
    id integer NOT NULL,
    user_id integer,
    filename character varying(255),
    original_name character varying,
    type character varying(255),
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


--
-- Name: cvs_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.cvs_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: cvs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.cvs_id_seq OWNED BY public.cvs.id;


--
-- Name: event_students; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.event_students (
    title character varying NOT NULL,
    student_id character varying NOT NULL,
    id integer NOT NULL,
    events_no character varying DEFAULT 'NULL'::character varying NOT NULL,
    course character varying DEFAULT 'NULL'::character varying NOT NULL,
    attendance boolean,
    passcode character varying DEFAULT 'NULL'::character varying NOT NULL,
    emails character varying(255) DEFAULT 'NULL'::character varying,
    mobiles character varying(255) DEFAULT 'NULL'::character varying NOT NULL
);


--
-- Name: files; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.files (
    id integer NOT NULL,
    description text,
    filename character varying(255) NOT NULL,
    original_name character varying(255) NOT NULL,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    user_id integer,
    is_public boolean
);


--
-- Name: files_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

ALTER TABLE public.files ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.files_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- Name: internship_roles; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.internship_roles (
    id integer NOT NULL,
    name character varying(255),
    description character varying(255),
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


--
-- Name: interviews; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.interviews (
    id integer NOT NULL,
    venue character varying,
    start_time time without time zone,
    end_time time without time zone,
    date date,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


--
-- Name: interviews_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.interviews_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: interviews_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.interviews_id_seq OWNED BY public.interviews.id;


--
-- Name: job_roles_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.job_roles_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: job_roles_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.job_roles_id_seq OWNED BY public.internship_roles.id;


--
-- Name: lecture_visit_lecturers; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.lecture_visit_lecturers (
    id integer NOT NULL,
    lecturer_id integer NOT NULL,
    lecturer_visit_id integer NOT NULL
);


--
-- Name: lecture_visit_lecturers_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

ALTER TABLE public.lecture_visit_lecturers ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.lecture_visit_lecturers_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- Name: lecturer_visit_rejected_reasons; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.lecturer_visit_rejected_reasons (
    id integer NOT NULL,
    lecturer_visit_id integer,
    reason text NOT NULL,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


--
-- Name: lecturer_visit_rejected_reasons_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

ALTER TABLE public.lecturer_visit_rejected_reasons ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.lecturer_visit_rejected_reasons_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- Name: lecturer_visits; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.lecturer_visits (
    id integer NOT NULL,
    company_id integer NOT NULL,
    "time" time without time zone,
    report_file_id integer,
    date date,
    "status[depricated]" public.visit_status DEFAULT 'pending'::public.visit_status,
    batch_id integer,
    approved boolean,
    rejected boolean,
    visited boolean
);


--
-- Name: lecturer_visits_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

ALTER TABLE public.lecturer_visits ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.lecturer_visits_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- Name: lecturers; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.lecturers (
    title character varying NOT NULL,
    employee_id character varying NOT NULL,
    id integer NOT NULL,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


--
-- Name: lecturers_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.lecturers_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: lecturers_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.lecturers_id_seq OWNED BY public.lecturers.id;


--
-- Name: notifications; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.notifications (
    id integer NOT NULL,
    user_id integer NOT NULL,
    title text NOT NULL,
    message text,
    is_read boolean DEFAULT false,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    action_url text,
    expires_at timestamp without time zone
);


--
-- Name: notifications_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.notifications_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: notifications_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.notifications_id_seq OWNED BY public.notifications.id;


--
-- Name: password_resets; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.password_resets (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    expiry timestamp without time zone NOT NULL,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


--
-- Name: password_reset_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.password_reset_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: password_reset_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.password_reset_id_seq OWNED BY public.password_resets.email;


--
-- Name: pdcs; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.pdcs (
    title character varying NOT NULL,
    employee_id character varying NOT NULL,
    id integer NOT NULL,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


--
-- Name: qrcodes; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.qrcodes (
    id integer NOT NULL,
    data text NOT NULL,
    filename character varying(255) NOT NULL,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


--
-- Name: qrcodes_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

ALTER TABLE public.qrcodes ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.qrcodes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- Name: qualifications; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.qualifications (
    id integer NOT NULL,
    description character varying(255),
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


--
-- Name: qualifications_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.qualifications_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: qualifications_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.qualifications_id_seq OWNED BY public.qualifications.id;


--
-- Name: reports; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.reports (
    id integer NOT NULL,
    sender_id integer NOT NULL,
    subject_id integer NOT NULL,
    filename text NOT NULL,
    original_name text NOT NULL,
    description text,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


--
-- Name: reports_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.reports_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: reports_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.reports_id_seq OWNED BY public.reports.id;


--
-- Name: responsibilities; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.responsibilities (
    id integer NOT NULL,
    advertisement_id integer,
    description text,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


--
-- Name: responsibilities_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.responsibilities_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: responsibilities_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.responsibilities_id_seq OWNED BY public.responsibilities.id;


--
-- Name: roles; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.roles (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


--
-- Name: roles_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.roles_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: roles_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.roles_id_seq OWNED BY public.roles.id;


--
-- Name: second_round_roles; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.second_round_roles (
    id integer NOT NULL,
    internship_role_id integer,
    student_id integer,
    cv_id integer,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


--
-- Name: second_round_roles_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.second_round_roles_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: second_round_roles_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.second_round_roles_id_seq OWNED BY public.second_round_roles.id;


--
-- Name: settings; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.settings (
    id integer NOT NULL,
    key character varying(255) NOT NULL,
    value character varying(255) NOT NULL,
    description text,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


--
-- Name: settings_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.settings_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: settings_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.settings_id_seq OWNED BY public.settings.id;


--
-- Name: students; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.students (
    id integer DEFAULT nextval('public.ads_id_seq'::regclass) NOT NULL,
    registration_number character varying(255) NOT NULL,
    course public.course_enum,
    index_number integer NOT NULL,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    website text
);


--
-- Name: students_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.students_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: students_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.students_id_seq OWNED BY public.students.id;


--
-- Name: students_qualifications; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.students_qualifications (
    student_id integer NOT NULL,
    qualification_id integer NOT NULL
);


--
-- Name: techtalk_slots; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.techtalk_slots (
    id integer NOT NULL,
    pdc_id integer,
    datetime timestamp without time zone,
    venue character varying(255),
    slot_created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


--
-- Name: techtalks; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.techtalks (
    id integer NOT NULL,
    techtalk_slot_id integer,
    company_id integer,
    host_name character varying DEFAULT 'NULL'::character varying,
    host_email character varying DEFAULT 'NULL'::character varying,
    description character varying,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


--
-- Name: techtalks_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.techtalks_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: techtalks_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.techtalks_id_seq OWNED BY public.techtalk_slots.id;


--
-- Name: techtalks_id_seq1; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.techtalks_id_seq1
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: techtalks_id_seq1; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.techtalks_id_seq1 OWNED BY public.techtalks.id;


--
-- Name: training_session_registrations; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.training_session_registrations (
    id integer NOT NULL,
    training_session_id integer NOT NULL,
    user_id integer NOT NULL,
    attended boolean,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


--
-- Name: training_session_attendances_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

ALTER TABLE public.training_session_registrations ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.training_session_attendances_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- Name: training_sessions; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.training_sessions (
    id integer NOT NULL,
    name character varying NOT NULL,
    date date NOT NULL,
    start_time time without time zone NOT NULL,
    venue character varying NOT NULL,
    end_time time without time zone,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    attendance_code text,
    qrcode_id integer
);


--
-- Name: training_session_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

ALTER TABLE public.training_sessions ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.training_session_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- Name: users; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.users (
    id integer NOT NULL,
    email character varying(255) NOT NULL,
    password character varying(255) NOT NULL,
    role integer NOT NULL,
    mobile character varying(255),
    disabled boolean,
    approved boolean,
    name character varying(255),
    rejected boolean,
    photo character varying(255),
    bio text,
    linkedin text,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.users_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- Name: advertisements id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.advertisements ALTER COLUMN id SET DEFAULT nextval('public.ads_id_seq'::regclass);


--
-- Name: advertisements_qualifications advertisement_id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.advertisements_qualifications ALTER COLUMN advertisement_id SET DEFAULT nextval('public.ads_qualifications_id_seq'::regclass);


--
-- Name: applications id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.applications ALTER COLUMN id SET DEFAULT nextval('public.applications_id_seq'::regclass);


--
-- Name: blacklist_reasons id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.blacklist_reasons ALTER COLUMN id SET DEFAULT nextval('public.blacklist_reasons_id_seq'::regclass);


--
-- Name: companies id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.companies ALTER COLUMN id SET DEFAULT nextval('public.companies_id_seq'::regclass);


--
-- Name: complaints id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.complaints ALTER COLUMN id SET DEFAULT nextval('public.complaints_id_seq'::regclass);


--
-- Name: cvs id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.cvs ALTER COLUMN id SET DEFAULT nextval('public.cvs_id_seq'::regclass);


--
-- Name: internship_roles id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.internship_roles ALTER COLUMN id SET DEFAULT nextval('public.job_roles_id_seq'::regclass);


--
-- Name: interviews id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.interviews ALTER COLUMN id SET DEFAULT nextval('public.interviews_id_seq'::regclass);


--
-- Name: notifications id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.notifications ALTER COLUMN id SET DEFAULT nextval('public.notifications_id_seq'::regclass);


--
-- Name: qualifications id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.qualifications ALTER COLUMN id SET DEFAULT nextval('public.qualifications_id_seq'::regclass);


--
-- Name: reports id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.reports ALTER COLUMN id SET DEFAULT nextval('public.reports_id_seq'::regclass);


--
-- Name: responsibilities id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.responsibilities ALTER COLUMN id SET DEFAULT nextval('public.responsibilities_id_seq'::regclass);


--
-- Name: roles id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.roles ALTER COLUMN id SET DEFAULT nextval('public.roles_id_seq'::regclass);


--
-- Name: second_round_roles id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.second_round_roles ALTER COLUMN id SET DEFAULT nextval('public.second_round_roles_id_seq'::regclass);


--
-- Name: settings id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.settings ALTER COLUMN id SET DEFAULT nextval('public.settings_id_seq'::regclass);


--
-- Name: techtalk_slots id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.techtalk_slots ALTER COLUMN id SET DEFAULT nextval('public.techtalks_id_seq'::regclass);


--
-- Name: techtalks id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.techtalks ALTER COLUMN id SET DEFAULT nextval('public.techtalks_id_seq1'::regclass);


--
-- Name: users id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- Name: admins admins_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.admins
    ADD CONSTRAINT admins_pkey PRIMARY KEY (id);


--
-- Name: advertisements ads_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.advertisements
    ADD CONSTRAINT ads_pkey PRIMARY KEY (id);


--
-- Name: advertisements_qualifications ads_qualifications_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.advertisements_qualifications
    ADD CONSTRAINT ads_qualifications_pkey PRIMARY KEY (advertisement_id);


--
-- Name: applications applications_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.applications
    ADD CONSTRAINT applications_pkey PRIMARY KEY (id);


--
-- Name: batches batches_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.batches
    ADD CONSTRAINT batches_pkey PRIMARY KEY (id);


--
-- Name: blacklist_reasons blacklist_reasons_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.blacklist_reasons
    ADD CONSTRAINT blacklist_reasons_pkey PRIMARY KEY (id);


--
-- Name: companies companies_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.companies
    ADD CONSTRAINT companies_pkey PRIMARY KEY (id);


--
-- Name: complaint_messages complaint_messages_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.complaint_messages
    ADD CONSTRAINT complaint_messages_pkey PRIMARY KEY (id);


--
-- Name: complaints complaints_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.complaints
    ADD CONSTRAINT complaints_pkey PRIMARY KEY (id);


--
-- Name: cvs cvs_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.cvs
    ADD CONSTRAINT cvs_pkey PRIMARY KEY (id);


--
-- Name: event_students event_students_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.event_students
    ADD CONSTRAINT event_students_pkey PRIMARY KEY (id);


--
-- Name: files files_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.files
    ADD CONSTRAINT files_pkey PRIMARY KEY (id);


--
-- Name: interviews interviews_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.interviews
    ADD CONSTRAINT interviews_pkey PRIMARY KEY (id);


--
-- Name: internship_roles job_roles_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.internship_roles
    ADD CONSTRAINT job_roles_pkey PRIMARY KEY (id);


--
-- Name: lecture_visit_lecturers lecture_visit_lecturers_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.lecture_visit_lecturers
    ADD CONSTRAINT lecture_visit_lecturers_pkey PRIMARY KEY (id);


--
-- Name: lecturer_visit_rejected_reasons lecturer_visit_rejected_reasons_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.lecturer_visit_rejected_reasons
    ADD CONSTRAINT lecturer_visit_rejected_reasons_pkey PRIMARY KEY (id);


--
-- Name: lecturer_visits lecturer_visits_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.lecturer_visits
    ADD CONSTRAINT lecturer_visits_pkey PRIMARY KEY (id);


--
-- Name: lecturers lecturers_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.lecturers
    ADD CONSTRAINT lecturers_pkey PRIMARY KEY (id);


--
-- Name: notifications notifications_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.notifications
    ADD CONSTRAINT notifications_pkey PRIMARY KEY (id);


--
-- Name: password_resets password_reset_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.password_resets
    ADD CONSTRAINT password_reset_pkey PRIMARY KEY (email);


--
-- Name: pdcs pdcs  _pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.pdcs
    ADD CONSTRAINT "pdcs  _pkey" PRIMARY KEY (id);


--
-- Name: qrcodes qrcodes_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.qrcodes
    ADD CONSTRAINT qrcodes_pkey PRIMARY KEY (id);


--
-- Name: qualifications qualifications_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.qualifications
    ADD CONSTRAINT qualifications_pkey PRIMARY KEY (id);


--
-- Name: reports reports_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.reports
    ADD CONSTRAINT reports_pkey PRIMARY KEY (id);


--
-- Name: responsibilities responsibilities_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.responsibilities
    ADD CONSTRAINT responsibilities_pkey PRIMARY KEY (id);


--
-- Name: roles roles_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.roles
    ADD CONSTRAINT roles_pkey PRIMARY KEY (id);


--
-- Name: second_round_roles second_round_roles_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.second_round_roles
    ADD CONSTRAINT second_round_roles_pkey PRIMARY KEY (id);


--
-- Name: settings settings_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.settings
    ADD CONSTRAINT settings_pkey PRIMARY KEY (id);


--
-- Name: students_qualifications student_qualification_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.students_qualifications
    ADD CONSTRAINT student_qualification_pkey PRIMARY KEY (student_id, qualification_id);


--
-- Name: students students_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.students
    ADD CONSTRAINT students_pkey PRIMARY KEY (id);


--
-- Name: techtalk_slots techtalks_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.techtalk_slots
    ADD CONSTRAINT techtalks_pkey PRIMARY KEY (id);


--
-- Name: techtalks techtalks_pkey1; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.techtalks
    ADD CONSTRAINT techtalks_pkey1 PRIMARY KEY (id);


--
-- Name: training_session_registrations training_session_attendances_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.training_session_registrations
    ADD CONSTRAINT training_session_attendances_pkey PRIMARY KEY (id);


--
-- Name: training_session_registrations training_session_attendances_training_session_id_user_id_key; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.training_session_registrations
    ADD CONSTRAINT training_session_attendances_training_session_id_user_id_key UNIQUE (training_session_id, user_id);


--
-- Name: training_sessions training_session_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.training_sessions
    ADD CONSTRAINT training_session_pkey PRIMARY KEY (id);


--
-- Name: lecturer_visits unique_company_date_time; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.lecturer_visits
    ADD CONSTRAINT unique_company_date_time UNIQUE (company_id, date, "time");


--
-- Name: blacklist_reasons unique_company_id; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.blacklist_reasons
    ADD CONSTRAINT unique_company_id UNIQUE (company_id);


--
-- Name: settings unique_key; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.settings
    ADD CONSTRAINT unique_key UNIQUE (key);


--
-- Name: applications unique_student_ad; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.applications
    ADD CONSTRAINT unique_student_ad UNIQUE (student_id, ad_id);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: email_unique; Type: INDEX; Schema: public; Owner: -
--

CREATE UNIQUE INDEX email_unique ON public.users USING btree (email);


--
-- Name: event_students_student_id_unique; Type: INDEX; Schema: public; Owner: -
--

CREATE UNIQUE INDEX event_students_student_id_unique ON public.event_students USING btree (student_id);


--
-- Name: lecturer_employee_id_unique; Type: INDEX; Schema: public; Owner: -
--

CREATE UNIQUE INDEX lecturer_employee_id_unique ON public.lecturers USING btree (employee_id);


--
-- Name: pdcs_employee_id_unique; Type: INDEX; Schema: public; Owner: -
--

CREATE UNIQUE INDEX pdcs_employee_id_unique ON public.pdcs USING btree (employee_id);


--
-- Name: applications prevent_multiple_selected_trigger; Type: TRIGGER; Schema: public; Owner: -
--

CREATE TRIGGER prevent_multiple_selected_trigger BEFORE INSERT OR UPDATE OF selected ON public.applications FOR EACH ROW EXECUTE FUNCTION public.prevent_multiple_selected();


--
-- Name: event_students event_students_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.event_students
    ADD CONSTRAINT event_students_user_id_fkey FOREIGN KEY (id) REFERENCES public.users(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: lecturers lecturers_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.lecturers
    ADD CONSTRAINT lecturers_id_fkey FOREIGN KEY (id) REFERENCES public.users(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: pdcs pdcs  _id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.pdcs
    ADD CONSTRAINT "pdcs  _id_fkey" FOREIGN KEY (id) REFERENCES public.users(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: users users_role_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_role_fkey FOREIGN KEY (role) REFERENCES public.roles(id);


--
-- PostgreSQL database dump complete
--

