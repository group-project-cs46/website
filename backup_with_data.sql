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
-- Data for Name: admins; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.admins (id, created_at) FROM stdin;
1	2025-04-26 04:23:40.207341
\.


--
-- Data for Name: advertisements; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.advertisements (id, pdc_id, max_cvs, responsibilities, qualifications_skills, deadline, vacancy_count, company_id, batch_id, internship_role_id, approved, created_at, photo_id) FROM stdin;
179	\N	2	dvhjbfhj	chdshvhd	2025-04-27	21	313	6	7	\N	2025-04-26 10:37:04.697805	12
175	\N	29	Develop and maintain web applications.\r\nWrite clean, scalable code following coding standards.\r\nCollaborate with cross-functional teams for new feature implementation.\r\nConduct code reviews and maintain documentation.\r\n	Bachelor's degree in Computer Science or equivalent.\r\nProficiency in Java, Spring Boot, and REST APIs.\r\nSolid understanding of SQL and relational databases.\r\nStrong problem-solving skills and debugging techniques.\r\n	2025-05-11	5	309	6	13	t	2025-04-26 04:56:27.347654	8
184	\N	10	- Provide technical support for computer systems, hardware, and software.\r\n- Troubleshoot issues and provide timely solutions.\r\n- Install and configure software and computer systems.	- Bachelor's degree in Computer Science, Information Technology, or related field.\r\n- Strong knowledge of Windows and Mac operating systems.	2025-05-14	5	309	6	7	\N	2025-04-28 06:29:59.412217	26
\.


--
-- Data for Name: advertisements_qualifications; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.advertisements_qualifications (advertisement_id, qualification_id, created_at) FROM stdin;
\.


--
-- Data for Name: applications; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.applications (id, student_id, cv_id, ad_id, interview_id, selected, failed, shortlisted, is_second_round, created_at) FROM stdin;
56	311	32	175	\N	\N	\N	\N	\N	2025-04-26 04:57:40.494195
\.


--
-- Data for Name: batches; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.batches (id, created_at, first_round_start_time, second_round_start_time, description, first_round_end_time, second_round_end_time) FROM stdin;
6	2025-04-26 04:53:39.995156	2025-04-26 10:00:00	\N	\N	2025-05-26 10:00:00	\N
\.


--
-- Data for Name: blacklist_reasons; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.blacklist_reasons (id, company_id, reason) FROM stdin;
\.


--
-- Data for Name: companies; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.companies (id, website, building, street_name, city, postal_code, address_line_2, created_at) FROM stdin;
309	https://www.mitesp.com	752	Dr. Danister De Silva Mawatha	Colombo	00900		2025-04-26 04:45:36.918089
313	https://wso2.com	410	Rajagiriya Road	Colombo	10107		2025-04-26 06:11:47.398367
362	https://techspark.lk	 45/A	D. R. Wijewardena Mawatha	Colombo	01000		2025-04-27 00:55:38.222699
\.


--
-- Data for Name: complaint_messages; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.complaint_messages (id, complaint_id, sender_id, message, created_at) FROM stdin;
43	39	1	Hi	2025-04-26 11:11:58.87166
44	40	311	Hi	2025-04-26 12:02:03.984735
45	41	313	hii\r\n	2025-04-26 12:25:08.929937
46	39	309	jhgh	2025-04-26 16:30:37.175257
47	42	311	I would like to clarify some points regarding the issue I raised. Could you please confirm if my complaint is being processed?	2025-04-26 22:45:57.124475
48	42	1	We have investigated your complaint and have taken the necessary action. The status has been updated accordingly	2025-04-26 22:47:03.791405
49	43	1	Hello	2025-04-27 14:59:38.744248
\.


--
-- Data for Name: complaints; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.complaints (id, complainant_id, accused_id, subject, description, status, created_at, complaint_type) FROM stdin;
45	309	1	system error 	some kind of delay	resolved	2025-04-27 00:01:49.141768	system
42	313	1	system error 	system error occur some time	rejected	2025-04-26 12:26:39.316864	system
43	309	1	system error 	system error Occur	rejected	2025-04-26 15:19:22.546629	system
40	311	309	Hello	Lorem ipsum dolor sit amen lorem ipsum dolor sit ametLorem ipsum dolor sit amen lorem ipsum dolor sit ametLorem ipsum dolor sit amen lorem ipsum dolor sit ametLorem ipsum dolor sit amen lorem ipsum dolor sit ametLorem ipsum dolor sit amen lorem ipsum dolor sit ametLorem ipsum dolor sit amen lorem ipsum dolor sit ametLorem ipsum dolor sit amen lorem ipsum dolor sit ametLorem ipsum dolor sit amen lorem ipsum dolor sit amet	resolved	2025-04-26 12:01:54.963352	\N
\.


--
-- Data for Name: cvs; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.cvs (id, user_id, filename, original_name, type, created_at) FROM stdin;
32	311	ce002afae3b3887cd0ff015857652f63.pdf	SCS 2210.pdf	First	2025-04-26 04:57:31.039312
35	311	2f06d7135c5a2cfb622586d64e1ae0a3.pdf	SCS 2211 Part B.pdf	Second	2025-04-26 13:02:08.293555
36	311	d8e10dcd62e9cfdc32d5df77c17100c1.pdf	test_cv.pdf	Professional	2025-04-27 05:41:47.232541
37	311	fd8628dd497fe07d9ac75e2c3cf28463.pdf	test_cv.pdf	Professional	2025-04-27 05:43:18.25205
38	311	680f451281bf7aad307552e32bf16d09.pdf	test_cv.pdf	Professional	2025-04-27 10:06:17.934935
39	385	be14826364f4ab518e9a2f56ebf6dbc4.pdf	SCS 2210.pdf	One	2025-04-27 10:17:09.855166
40	311	f1c2e414b347d8545dbb89eb2e0b2872.pdf	test_cv.pdf	Professional	2025-04-27 10:18:39.716618
\.


--
-- Data for Name: event_students; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.event_students (title, student_id, id, events_no, course, attendance, passcode, emails, mobiles) FROM stdin;
\.


--
-- Data for Name: files; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.files (id, description, filename, original_name, created_at, user_id, is_public) FROM stdin;
8		d39fba23a85baed6663168d0959059ed.png	SE.png	2025-04-26 04:56:27.1225	309	t
9		e037e4177f5c3929c353c4793172a191.jpeg	images.jpeg	2025-04-26 07:56:47.43119	313	t
10		287f55ea923030cbbfe8cadf162a4bdc.jpeg	images.jpeg	2025-04-26 09:05:32.118261	313	t
12		b0a0490d87529615c138c42583470d7b.png	SE.png	2025-04-26 10:37:04.624918	313	t
17		8a156bd01be0785fe5a1c7865aba5db8.pdf	SCS 2210.pdf	2025-04-27 13:47:40.513862	312	t
18		ee2362fc81cdf9d2d1db3cba2a60453b.pdf	SCS 2210.pdf	2025-04-27 13:53:34.29329	312	t
23		5e2e84a1bf98825745cafd1c6a8e3ddf.pdf	SCS 2210.pdf	2025-04-27 14:32:52.577151	312	t
25		bda09fc6fd650c4a128b553e3a83ad6d.pdf	TimeTable.pdf	2025-04-28 02:55:04.828184	312	t
26		0f5ecaca7adff694771cfe1001ae364c.jpg	we-are.jpg	2025-04-28 06:29:59.287016	309	t
\.


--
-- Data for Name: internship_roles; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.internship_roles (id, name, description, created_at) FROM stdin;
7	IT Support Specialist	\N	2025-04-20 05:46:02.580818
8	Data Analyst	\N	2025-04-20 05:46:02.580818
9	Cloud Engineer	\N	2025-04-20 05:46:02.580818
10	Cybersecurity Analyst	\N	2025-04-20 05:46:02.580818
11	DevOps Engineer	\N	2025-04-20 05:46:02.580818
12	AI/ML Engineer	\N	2025-04-20 05:46:02.580818
13	Software Engineer	\N	2025-04-20 05:46:02.580818
17	Quality Assurance Engineer		2025-04-26 14:02:28.627651
\.


--
-- Data for Name: interviews; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.interviews (id, venue, start_time, end_time, date, created_at) FROM stdin;
34	jaffna	09:38:00	10:38:00	2025-04-03	2025-04-26 22:09:06.764862
35	752 , Dr. Danister De Silva Mawatha, Colombo	09:00:00	10:00:00	2025-05-04	2025-04-26 22:22:22.527157
36	752 , Dr. Danister De Silva Mawatha, Colombo	08:00:00	11:00:00	2025-05-11	2025-04-26 22:26:50.19666
37	752 , Dr. Danister De Silva Mawatha, Colombo	10:00:00	11:00:00	2025-05-25	2025-04-27 00:19:12.181364
38	752 , Dr. Danister De Silva Mawatha, Colombo	10:00:00	11:00:00	2025-05-25	2025-04-27 00:19:12.997007
\.


--
-- Data for Name: lecture_visit_lecturers; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.lecture_visit_lecturers (id, lecturer_id, lecturer_visit_id) FROM stdin;
8	312	2
15	390	33
17	312	35
18	312	36
19	390	38
20	312	40
\.


--
-- Data for Name: lecturer_visit_rejected_reasons; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.lecturer_visit_rejected_reasons (id, lecturer_visit_id, reason, created_at) FROM stdin;
\.


--
-- Data for Name: lecturer_visits; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.lecturer_visits (id, company_id, "time", report_file_id, date, "status[depricated]", batch_id, approved, rejected, visited) FROM stdin;
33	309	15:00:00	\N	2025-04-28	pending	\N	\N	\N	\N
35	309	14:30:00	\N	2025-04-28	pending	\N	\N	\N	\N
36	313	16:31:00	\N	2025-04-28	pending	\N	\N	\N	\N
38	313	16:33:00	\N	2025-04-28	pending	\N	\N	\N	\N
40	313	16:43:00	25	2025-04-18	pending	\N	t	\N	\N
\.


--
-- Data for Name: lecturers; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.lecturers (title, employee_id, id, created_at) FROM stdin;
Mr	UCSC/LEC/231	436	2025-04-28 09:20:09.607006
Mr	UCSC/LEC/010	390	2025-04-27 14:22:51.843327
Dr	UCSC/LEC/001	312	2025-04-26 05:06:25.047853
Mr	UCSC/LEC/015	392	2025-04-27 18:29:51.669448
\.


--
-- Data for Name: notifications; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.notifications (id, user_id, title, message, is_read, created_at, action_url, expires_at) FROM stdin;
153	307	Student Selected	Student 22001440 has been selected by MillenniumIT ESP	f	2025-04-26 05:02:46.331843	\N	2025-04-27 07:02:46
154	308	Student Selected	Student 22001440 has been selected by MillenniumIT ESP	f	2025-04-26 05:02:46.410742	\N	2025-04-27 07:02:46
195	307	New Tech Talk Scheduled	A new tech talk has been scheduled by MillenniumIT ESP on 2025-04-30 at 03:00 PM	f	2025-04-26 17:43:38.591923	\N	2025-04-27 19:43:38
155	307	New Tech Talk Scheduled	A new tech talk has been scheduled by MillenniumIT ESP on 2025-04-30 at 03:00 PM	f	2025-04-26 05:06:12.980336	\N	2025-04-27 07:06:12
156	308	New Tech Talk Scheduled	A new tech talk has been scheduled by MillenniumIT ESP on 2025-04-30 at 03:00 PM	f	2025-04-26 05:06:13.060099	\N	2025-04-27 07:06:12
157	307	New Complaint Submitted	A new student complaint has been submitted by MillenniumIT ESP	f	2025-04-26 05:55:43.79055	\N	2025-04-27 11:25:43
158	308	New Complaint Submitted	A new student complaint has been submitted by MillenniumIT ESP	f	2025-04-26 05:55:43.873087	\N	2025-04-27 11:25:43
159	307	New Report Uploaded	A new report for student 22001440 has been uploaded by MillenniumIT ESP	f	2025-04-26 05:57:18.045582	\N	2025-04-27 07:57:17
160	308	New Report Uploaded	A new report for student 22001440 has been uploaded by MillenniumIT ESP	f	2025-04-26 05:57:18.120824	\N	2025-04-27 07:57:17
196	308	New Tech Talk Scheduled	A new tech talk has been scheduled by MillenniumIT ESP on 2025-04-30 at 03:00 PM	f	2025-04-26 17:43:38.670116	\N	2025-04-27 19:43:38
197	315	New Tech Talk Scheduled	A new tech talk has been scheduled by MillenniumIT ESP on 2025-04-30 at 03:00 PM	f	2025-04-26 17:43:38.741768	\N	2025-04-27 19:43:38
161	307	Lecturer Visit Approved	A lecturer visit by Pasindu (lecturer@launchpad.com) has been approved by MillenniumIT ESP on 2025-04-30 at 13:00:00	f	2025-04-26 07:43:52.023603	\N	2025-04-27 09:43:51
162	308	Lecturer Visit Approved	A lecturer visit by Pasindu (lecturer@launchpad.com) has been approved by MillenniumIT ESP on 2025-04-30 at 13:00:00	f	2025-04-26 07:43:52.113671	\N	2025-04-27 09:43:51
198	316	New Tech Talk Scheduled	A new tech talk has been scheduled by MillenniumIT ESP on 2025-04-30 at 03:00 PM	f	2025-04-26 17:43:38.832048	\N	2025-04-27 19:43:38
151	311	Interview Scheduled	Your interview has been scheduled by MillenniumIT ESP on 2025-05-03 from 11:00 to 11:30	f	2025-04-26 04:59:09.661973	\N	2025-04-27 06:59:09
152	311	Application Selected	You have been selected by MillenniumIT ESP	f	2025-04-26 05:02:46.026434	\N	2025-04-27 07:02:45
163	307	New Complaint Submitted	A new system complaint has been submitted by WSO2	f	2025-04-26 12:23:43.229768	\N	2025-04-27 17:53:42
164	308	New Complaint Submitted	A new system complaint has been submitted by WSO2	f	2025-04-26 12:23:43.307398	\N	2025-04-27 17:53:42
165	1	New System Complaint Submitted	A new system complaint has been submitted by WSO2	f	2025-04-26 12:23:43.387985	\N	2025-04-27 17:53:42
166	307	New Complaint Submitted	A new system complaint has been submitted by WSO2	f	2025-04-26 12:26:39.548039	\N	2025-04-27 17:56:38
167	308	New Complaint Submitted	A new system complaint has been submitted by WSO2	f	2025-04-26 12:26:39.626686	\N	2025-04-27 17:56:38
168	1	New System Complaint Submitted	A new system complaint has been submitted by WSO2	f	2025-04-26 12:26:39.700712	\N	2025-04-27 17:56:38
169	307	New Report Uploaded	A new report for student 22001440 has been uploaded by WSO2	f	2025-04-26 14:26:17.717595	\N	2025-04-27 16:26:16
170	308	New Report Uploaded	A new report for student 22001440 has been uploaded by WSO2	f	2025-04-26 14:26:17.807337	\N	2025-04-27 16:26:16
171	307	New Report Uploaded	A new report for student 22001440 has been uploaded by MillenniumIT ESP	f	2025-04-26 14:52:08.611585	\N	2025-04-27 16:52:07
172	308	New Report Uploaded	A new report for student 22001440 has been uploaded by MillenniumIT ESP	f	2025-04-26 14:52:08.691848	\N	2025-04-27 16:52:07
150	309	New application	You have a new application for the job Software Engineer from Thathsara	t	2025-04-26 04:57:40.578996	\N	2025-04-27 04:57:40
173	307	New Report Uploaded	A new report for student 22001440 has been uploaded by MillenniumIT ESP	f	2025-04-26 15:06:44.292476	\N	2025-04-27 17:06:43
174	308	New Report Uploaded	A new report for student 22001440 has been uploaded by MillenniumIT ESP	f	2025-04-26 15:06:44.369408	\N	2025-04-27 17:06:43
175	307	New Report Uploaded	A new report for student 22001440 has been uploaded by MillenniumIT ESP	f	2025-04-26 15:07:17.898067	\N	2025-04-27 17:07:16
176	308	New Report Uploaded	A new report for student 22001440 has been uploaded by MillenniumIT ESP	f	2025-04-26 15:07:17.968433	\N	2025-04-27 17:07:16
177	307	New Report Uploaded	A new report for student 22001440 has been uploaded by MillenniumIT ESP	f	2025-04-26 15:07:55.141408	\N	2025-04-27 17:07:53
178	308	New Report Uploaded	A new report for student 22001440 has been uploaded by MillenniumIT ESP	f	2025-04-26 15:07:55.223186	\N	2025-04-27 17:07:53
179	307	New Report Uploaded	A new report for student 22001440 has been uploaded by MillenniumIT ESP	f	2025-04-26 15:18:29.781451	\N	2025-04-27 17:18:28
180	308	New Report Uploaded	A new report for student 22001440 has been uploaded by MillenniumIT ESP	f	2025-04-26 15:18:29.855847	\N	2025-04-27 17:18:28
181	307	New Complaint Submitted	A new student complaint has been submitted by MillenniumIT ESP	f	2025-04-26 15:19:22.757537	\N	2025-04-27 20:49:21
182	308	New Complaint Submitted	A new student complaint has been submitted by MillenniumIT ESP	f	2025-04-26 15:19:22.841826	\N	2025-04-27 20:49:21
183	307	New Report Uploaded	A new report for student 22001440 has been uploaded by WSO2	f	2025-04-26 16:28:14.488821	\N	2025-04-27 18:28:13
184	308	New Report Uploaded	A new report for student 22001440 has been uploaded by WSO2	f	2025-04-26 16:28:14.573474	\N	2025-04-27 18:28:13
185	307	Lecturer Visit Approved	A lecturer visit by Pasindu (lecturer@launchpad.com) has been approved by WSO2 on 2025-05-01 at 13:00:00	f	2025-04-26 17:02:32.444208	\N	2025-04-27 19:02:32
186	308	Lecturer Visit Approved	A lecturer visit by Pasindu (lecturer@launchpad.com) has been approved by WSO2 on 2025-05-01 at 13:00:00	f	2025-04-26 17:02:32.520276	\N	2025-04-27 19:02:32
187	307	New Report Uploaded	A new report for student 22001440 has been uploaded by MillenniumIT ESP	f	2025-04-26 17:22:16.061128	\N	2025-04-27 19:22:16
188	308	New Report Uploaded	A new report for student 22001440 has been uploaded by MillenniumIT ESP	f	2025-04-26 17:22:16.164537	\N	2025-04-27 19:22:16
189	315	New Report Uploaded	A new report for student 22001440 has been uploaded by MillenniumIT ESP	f	2025-04-26 17:22:16.245321	\N	2025-04-27 19:22:16
190	316	New Report Uploaded	A new report for student 22001440 has been uploaded by MillenniumIT ESP	f	2025-04-26 17:22:16.331905	\N	2025-04-27 19:22:16
191	307	New Report Uploaded	A new report for student 22001440 has been uploaded by MillenniumIT ESP	f	2025-04-26 17:30:40.871813	\N	2025-04-27 19:30:40
192	308	New Report Uploaded	A new report for student 22001440 has been uploaded by MillenniumIT ESP	f	2025-04-26 17:30:40.947217	\N	2025-04-27 19:30:40
193	315	New Report Uploaded	A new report for student 22001440 has been uploaded by MillenniumIT ESP	f	2025-04-26 17:30:41.027229	\N	2025-04-27 19:30:40
194	316	New Report Uploaded	A new report for student 22001440 has been uploaded by MillenniumIT ESP	f	2025-04-26 17:30:41.106573	\N	2025-04-27 19:30:41
199	320	New Tech Talk Scheduled	A new tech talk has been scheduled by MillenniumIT ESP on 2025-04-30 at 03:00 PM	f	2025-04-26 17:43:38.906113	\N	2025-04-27 19:43:38
200	307	New Tech Talk Scheduled	A new tech talk has been scheduled by MillenniumIT ESP on 2025-04-30 at 03:00 PM	f	2025-04-26 17:46:01.063605	\N	2025-04-27 19:46:01
201	308	New Tech Talk Scheduled	A new tech talk has been scheduled by MillenniumIT ESP on 2025-04-30 at 03:00 PM	f	2025-04-26 17:46:01.256886	\N	2025-04-27 19:46:01
202	315	New Tech Talk Scheduled	A new tech talk has been scheduled by MillenniumIT ESP on 2025-04-30 at 03:00 PM	f	2025-04-26 17:46:01.987007	\N	2025-04-27 19:46:01
203	316	New Tech Talk Scheduled	A new tech talk has been scheduled by MillenniumIT ESP on 2025-04-30 at 03:00 PM	f	2025-04-26 17:46:02.058197	\N	2025-04-27 19:46:02
204	320	New Tech Talk Scheduled	A new tech talk has been scheduled by MillenniumIT ESP on 2025-04-30 at 03:00 PM	f	2025-04-26 17:46:02.138237	\N	2025-04-27 19:46:02
205	307	New Complaint Submitted	A new system complaint has been submitted by MillenniumIT ESP	f	2025-04-26 19:48:45.361069	\N	2025-04-28 01:18:45
206	308	New Complaint Submitted	A new system complaint has been submitted by MillenniumIT ESP	f	2025-04-26 19:48:45.435323	\N	2025-04-28 01:18:45
207	316	New Complaint Submitted	A new system complaint has been submitted by MillenniumIT ESP	f	2025-04-26 19:48:45.512892	\N	2025-04-28 01:18:45
208	328	New Complaint Submitted	A new system complaint has been submitted by MillenniumIT ESP	f	2025-04-26 19:48:45.585764	\N	2025-04-28 01:18:45
209	330	New Complaint Submitted	A new system complaint has been submitted by MillenniumIT ESP	f	2025-04-26 19:48:45.66575	\N	2025-04-28 01:18:45
210	315	New Complaint Submitted	A new system complaint has been submitted by MillenniumIT ESP	f	2025-04-26 19:48:45.746453	\N	2025-04-28 01:18:45
211	331	New Complaint Submitted	A new system complaint has been submitted by MillenniumIT ESP	f	2025-04-26 19:48:45.823979	\N	2025-04-28 01:18:45
212	333	New Complaint Submitted	A new system complaint has been submitted by MillenniumIT ESP	f	2025-04-26 19:48:45.899934	\N	2025-04-28 01:18:45
213	334	New Complaint Submitted	A new system complaint has been submitted by MillenniumIT ESP	f	2025-04-26 19:48:45.976239	\N	2025-04-28 01:18:45
214	337	New Complaint Submitted	A new system complaint has been submitted by MillenniumIT ESP	f	2025-04-26 19:48:46.062146	\N	2025-04-28 01:18:46
215	1	New System Complaint Submitted	A new system complaint has been submitted by MillenniumIT ESP	f	2025-04-26 19:48:46.140272	\N	2025-04-28 01:18:46
216	307	New Report Uploaded	A new report for student 22001440 has been uploaded by MillenniumIT ESP	f	2025-04-26 20:10:10.309398	\N	2025-04-27 22:10:10
217	308	New Report Uploaded	A new report for student 22001440 has been uploaded by MillenniumIT ESP	f	2025-04-26 20:10:10.397139	\N	2025-04-27 22:10:10
218	331	New Report Uploaded	A new report for student 22001440 has been uploaded by MillenniumIT ESP	f	2025-04-26 20:10:10.477602	\N	2025-04-27 22:10:10
219	346	New Report Uploaded	A new report for student 22001440 has been uploaded by MillenniumIT ESP	f	2025-04-26 20:10:10.552976	\N	2025-04-27 22:10:10
220	350	New Report Uploaded	A new report for student 22001440 has been uploaded by MillenniumIT ESP	f	2025-04-26 20:10:10.63704	\N	2025-04-27 22:10:10
221	351	New Report Uploaded	A new report for student 22001440 has been uploaded by MillenniumIT ESP	f	2025-04-26 20:10:10.712085	\N	2025-04-27 22:10:10
222	352	New Report Uploaded	A new report for student 22001440 has been uploaded by MillenniumIT ESP	f	2025-04-26 20:10:10.787032	\N	2025-04-27 22:10:10
223	307	New Tech Talk Scheduled	A new tech talk has been scheduled by MillenniumIT ESP on 2025-04-30 at 03:00 PM	f	2025-04-26 20:35:03.886694	\N	2025-04-27 22:35:03
224	308	New Tech Talk Scheduled	A new tech talk has been scheduled by MillenniumIT ESP on 2025-04-30 at 03:00 PM	f	2025-04-26 20:35:03.962278	\N	2025-04-27 22:35:03
225	331	New Tech Talk Scheduled	A new tech talk has been scheduled by MillenniumIT ESP on 2025-04-30 at 03:00 PM	f	2025-04-26 20:35:04.038154	\N	2025-04-27 22:35:03
226	346	New Tech Talk Scheduled	A new tech talk has been scheduled by MillenniumIT ESP on 2025-04-30 at 03:00 PM	f	2025-04-26 20:35:04.112483	\N	2025-04-27 22:35:03
227	350	New Tech Talk Scheduled	A new tech talk has been scheduled by MillenniumIT ESP on 2025-04-30 at 03:00 PM	f	2025-04-26 20:35:04.188145	\N	2025-04-27 22:35:03
228	351	New Tech Talk Scheduled	A new tech talk has been scheduled by MillenniumIT ESP on 2025-04-30 at 03:00 PM	f	2025-04-26 20:35:04.267226	\N	2025-04-27 22:35:04
229	352	New Tech Talk Scheduled	A new tech talk has been scheduled by MillenniumIT ESP on 2025-04-30 at 03:00 PM	f	2025-04-26 20:35:04.343133	\N	2025-04-27 22:35:04
230	307	Lecturer Visit Approved	A lecturer visit by Pasindu (lecturer@launchpad.com) has been approved by MillenniumIT ESP on 2025-04-30 at 13:00:00	f	2025-04-26 20:44:34.411151	\N	2025-04-27 22:44:34
231	308	Lecturer Visit Approved	A lecturer visit by Pasindu (lecturer@launchpad.com) has been approved by MillenniumIT ESP on 2025-04-30 at 13:00:00	f	2025-04-26 20:44:34.500212	\N	2025-04-27 22:44:34
232	331	Lecturer Visit Approved	A lecturer visit by Pasindu (lecturer@launchpad.com) has been approved by MillenniumIT ESP on 2025-04-30 at 13:00:00	f	2025-04-26 20:44:34.580934	\N	2025-04-27 22:44:34
233	346	Lecturer Visit Approved	A lecturer visit by Pasindu (lecturer@launchpad.com) has been approved by MillenniumIT ESP on 2025-04-30 at 13:00:00	f	2025-04-26 20:44:34.654976	\N	2025-04-27 22:44:34
234	350	Lecturer Visit Approved	A lecturer visit by Pasindu (lecturer@launchpad.com) has been approved by MillenniumIT ESP on 2025-04-30 at 13:00:00	f	2025-04-26 20:44:34.746497	\N	2025-04-27 22:44:34
235	351	Lecturer Visit Approved	A lecturer visit by Pasindu (lecturer@launchpad.com) has been approved by MillenniumIT ESP on 2025-04-30 at 13:00:00	f	2025-04-26 20:44:34.825636	\N	2025-04-27 22:44:34
236	352	Lecturer Visit Approved	A lecturer visit by Pasindu (lecturer@launchpad.com) has been approved by MillenniumIT ESP on 2025-04-30 at 13:00:00	f	2025-04-26 20:44:34.905941	\N	2025-04-27 22:44:34
237	307	Lecturer Visit Approved	A lecturer visit by Pasindu (lecturer@launchpad.com) has been approved by MillenniumIT ESP on 2025-04-30 at 13:00:00	f	2025-04-26 20:49:51.339752	\N	2025-04-27 22:49:51
238	308	Lecturer Visit Approved	A lecturer visit by Pasindu (lecturer@launchpad.com) has been approved by MillenniumIT ESP on 2025-04-30 at 13:00:00	f	2025-04-26 20:49:51.420893	\N	2025-04-27 22:49:51
239	331	Lecturer Visit Approved	A lecturer visit by Pasindu (lecturer@launchpad.com) has been approved by MillenniumIT ESP on 2025-04-30 at 13:00:00	f	2025-04-26 20:49:51.495475	\N	2025-04-27 22:49:51
240	346	Lecturer Visit Approved	A lecturer visit by Pasindu (lecturer@launchpad.com) has been approved by MillenniumIT ESP on 2025-04-30 at 13:00:00	f	2025-04-26 20:49:51.570491	\N	2025-04-27 22:49:51
241	350	Lecturer Visit Approved	A lecturer visit by Pasindu (lecturer@launchpad.com) has been approved by MillenniumIT ESP on 2025-04-30 at 13:00:00	f	2025-04-26 20:49:51.654846	\N	2025-04-27 22:49:51
242	351	Lecturer Visit Approved	A lecturer visit by Pasindu (lecturer@launchpad.com) has been approved by MillenniumIT ESP on 2025-04-30 at 13:00:00	f	2025-04-26 20:49:51.729101	\N	2025-04-27 22:49:51
243	352	Lecturer Visit Approved	A lecturer visit by Pasindu (lecturer@launchpad.com) has been approved by MillenniumIT ESP on 2025-04-30 at 13:00:00	f	2025-04-26 20:49:51.814524	\N	2025-04-27 22:49:51
244	311	Interview Scheduled	Your interview has been scheduled by MillenniumIT ESP on 2025-04-03 from 09:38 to 10:38	f	2025-04-26 22:09:07.099957	\N	2025-04-28 00:09:06
245	311	Interview Scheduled	Your interview has been scheduled by MillenniumIT ESP on 2025-05-04 from 09:00 to 10:00	f	2025-04-26 22:22:22.958264	\N	2025-04-28 00:22:22
246	311	Interview Scheduled	Your interview has been scheduled by MillenniumIT ESP on 2025-05-11 from 08:00 to 11:00	f	2025-04-26 22:26:50.540899	\N	2025-04-28 00:26:50
247	311	Application Selected	You have been selected by MillenniumIT ESP	f	2025-04-26 22:27:17.437239	\N	2025-04-28 00:27:17
248	307	Student Selected	Student 22001440 has been selected by MillenniumIT ESP	f	2025-04-26 22:27:17.591128	\N	2025-04-28 00:27:17
249	308	Student Selected	Student 22001440 has been selected by MillenniumIT ESP	f	2025-04-26 22:27:17.671983	\N	2025-04-28 00:27:17
250	311	Application Rejected	You have been rejected by MillenniumIT ESP	f	2025-04-26 22:29:43.533453	\N	2025-04-28 00:29:43
251	307	Student Application Rejected	Student 22001440 has been rejected by MillenniumIT ESP	f	2025-04-26 22:29:43.680577	\N	2025-04-28 00:29:43
252	308	Student Application Rejected	Student 22001440 has been rejected by MillenniumIT ESP	f	2025-04-26 22:29:43.75382	\N	2025-04-28 00:29:43
253	307	New Report Uploaded	A new report for student 22001440 has been uploaded by MillenniumIT ESP	f	2025-04-26 23:35:16.390859	\N	2025-04-28 01:35:16
254	308	New Report Uploaded	A new report for student 22001440 has been uploaded by MillenniumIT ESP	f	2025-04-26 23:35:16.47574	\N	2025-04-28 01:35:16
255	307	New Complaint Submitted	A new system complaint has been submitted by MillenniumIT ESP	f	2025-04-27 00:01:49.360206	\N	2025-04-28 05:31:49
256	308	New Complaint Submitted	A new system complaint has been submitted by MillenniumIT ESP	f	2025-04-27 00:01:49.438559	\N	2025-04-28 05:31:49
257	1	New System Complaint Submitted	A new system complaint has been submitted by MillenniumIT ESP	f	2025-04-27 00:01:49.532041	\N	2025-04-28 05:31:49
258	307	New Tech Talk Scheduled	A new tech talk has been scheduled by MillenniumIT ESP on 2025-04-30 at 03:00 PM	f	2025-04-27 00:09:11.80711	\N	2025-04-28 02:09:11
259	308	New Tech Talk Scheduled	A new tech talk has been scheduled by MillenniumIT ESP on 2025-04-30 at 03:00 PM	f	2025-04-27 00:09:11.881709	\N	2025-04-28 02:09:12
260	307	Lecturer Visit Approved	A lecturer visit by Pasindu (lecturer@launchpad.com) has been approved by MillenniumIT ESP on 2025-04-30 at 13:00:00	f	2025-04-27 00:11:48.416554	\N	2025-04-28 02:11:48
261	308	Lecturer Visit Approved	A lecturer visit by Pasindu (lecturer@launchpad.com) has been approved by MillenniumIT ESP on 2025-04-30 at 13:00:00	f	2025-04-27 00:11:48.497286	\N	2025-04-28 02:11:48
262	311	Application Rejected	You have been rejected by MillenniumIT ESP	f	2025-04-27 00:15:23.322533	\N	2025-04-28 02:15:23
263	307	Student Application Rejected	Student 22001440 has been rejected by MillenniumIT ESP	f	2025-04-27 00:15:23.467381	\N	2025-04-28 02:15:23
264	308	Student Application Rejected	Student 22001440 has been rejected by MillenniumIT ESP	f	2025-04-27 00:15:23.537924	\N	2025-04-28 02:15:23
265	311	Interview Scheduled	Your interview has been scheduled by MillenniumIT ESP on 2025-05-25 from 10:00 to 11:00	f	2025-04-27 00:19:12.535736	\N	2025-04-28 02:19:12
266	311	Interview Scheduled	Your interview has been scheduled by MillenniumIT ESP on 2025-05-25 from 10:00 to 11:00	f	2025-04-27 00:19:13.378195	\N	2025-04-28 02:19:13
267	311	Application Selected	You have been selected by MillenniumIT ESP	f	2025-04-27 00:19:36.340552	\N	2025-04-28 02:19:36
268	307	Student Selected	Student 22001440 has been selected by MillenniumIT ESP	f	2025-04-27 00:19:36.479066	\N	2025-04-28 02:19:36
269	308	Student Selected	Student 22001440 has been selected by MillenniumIT ESP	f	2025-04-27 00:19:36.550507	\N	2025-04-28 02:19:36
271	307	New Report Uploaded	A new report for student 22001440 has been uploaded by MillenniumIT ESP	f	2025-04-27 17:45:37.445516	\N	2025-04-28 19:45:36
272	308	New Report Uploaded	A new report for student 22001440 has been uploaded by MillenniumIT ESP	f	2025-04-27 17:45:37.519795	\N	2025-04-28 19:45:36
273	389	New Report Uploaded	A new report for student 22001440 has been uploaded by MillenniumIT ESP	f	2025-04-27 17:45:37.592012	\N	2025-04-28 19:45:37
274	307	New Report Uploaded	A new report for student 22001440 has been uploaded by MillenniumIT ESP	f	2025-04-27 17:46:03.192839	\N	2025-04-28 19:46:02
275	308	New Report Uploaded	A new report for student 22001440 has been uploaded by MillenniumIT ESP	f	2025-04-27 17:46:03.266757	\N	2025-04-28 19:46:02
276	389	New Report Uploaded	A new report for student 22001440 has been uploaded by MillenniumIT ESP	f	2025-04-27 17:46:03.347245	\N	2025-04-28 19:46:02
277	307	New Report Uploaded	A new report for student 22001440 has been uploaded by MillenniumIT ESP	f	2025-04-27 17:46:32.733083	\N	2025-04-28 19:46:32
278	308	New Report Uploaded	A new report for student 22001440 has been uploaded by MillenniumIT ESP	f	2025-04-27 17:46:32.808979	\N	2025-04-28 19:46:32
279	389	New Report Uploaded	A new report for student 22001440 has been uploaded by MillenniumIT ESP	f	2025-04-27 17:46:32.888604	\N	2025-04-28 19:46:32
281	313	Upcoming Tech Talk Scheduled	A new Tech Talk has been scheduled on 2025-04-29 at 13:30, Venue: S204. Don't miss it!	f	2025-04-28 05:56:01.418707	\N	2025-04-29 05:55:58
282	362	Upcoming Tech Talk Scheduled	A new Tech Talk has been scheduled on 2025-04-29 at 13:30, Venue: S204. Don't miss it!	f	2025-04-28 05:56:01.498671	\N	2025-04-29 05:55:58
283	311	Upcoming Tech Talk Scheduled	A new Tech Talk has been scheduled on 2025-04-29 at 13:30, Venue: S204. Make sure to attend!	f	2025-04-28 05:56:01.718685	\N	2025-04-29 05:55:58
284	317	Upcoming Tech Talk Scheduled	A new Tech Talk has been scheduled on 2025-04-29 at 13:30, Venue: S204. Make sure to attend!	f	2025-04-28 05:56:01.818599	\N	2025-04-29 05:55:58
285	415	Upcoming Tech Talk Scheduled	A new Tech Talk has been scheduled on 2025-04-29 at 13:30, Venue: S204. Make sure to attend!	f	2025-04-28 05:56:01.948728	\N	2025-04-29 05:55:58
286	416	Upcoming Tech Talk Scheduled	A new Tech Talk has been scheduled on 2025-04-29 at 13:30, Venue: S204. Make sure to attend!	f	2025-04-28 05:56:02.078691	\N	2025-04-29 05:55:59
287	417	Upcoming Tech Talk Scheduled	A new Tech Talk has been scheduled on 2025-04-29 at 13:30, Venue: S204. Make sure to attend!	f	2025-04-28 05:56:02.178622	\N	2025-04-29 05:55:59
280	309	Upcoming Tech Talk Scheduled	A new Tech Talk has been scheduled on 2025-04-29 at 13:30, Venue: S204. Don't miss it!	t	2025-04-28 05:56:01.298597	\N	2025-04-29 05:55:58
270	309	New application	You have a new application for the job Software Engineer from Nijani T.	t	2025-04-27 10:17:27.030241	\N	2025-04-28 10:17:26
\.


--
-- Data for Name: password_resets; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.password_resets (email, token, expiry, created_at) FROM stdin;
lecturer@launchpad.com	2e0eb7b4493afdc23a9fa7bc9b2755c2f02905a5a16086e875055ff4f8c226e1	2025-04-27 03:43:28	2025-04-27 02:43:29.308582
\.


--
-- Data for Name: pdcs; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.pdcs (title, employee_id, id, created_at) FROM stdin;
mr	UCSC/PDC/001	307	2025-04-26 04:41:04.687586
mr	UCSC/PDC/002	308	2025-04-26 04:42:31.414549
\.


--
-- Data for Name: qrcodes; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.qrcodes (id, data, filename, created_at) FROM stdin;
18	ABC1234@	1ea7ad0f073bcb2aedf199573d01fa95.png	2025-04-26 04:59:26.708402
19	UcsC$1225	2e46d3be242d1683f1acd4c102dd92e2.png	2025-04-26 22:34:13.143409
20	ucsc@10%$	a288221bb11dc74fa45b3f426a53442e.png	2025-04-26 22:58:34.484637
21	S104ucsC@%	051cc8e0940caac52a84a918bfe1ef7f.png	2025-04-27 14:40:32.004883
22	12345678	566304c971e8a993077f4d386d3ac1e3.png	2025-04-28 06:20:06.388478
23	456565	a1da96846a7385431d0940628b55f047.png	2025-04-28 06:23:55.321359
\.


--
-- Data for Name: qualifications; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.qualifications (id, description, created_at) FROM stdin;
\.


--
-- Data for Name: reports; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.reports (id, sender_id, subject_id, filename, original_name, description, created_at) FROM stdin;
66	311	309	0f45102e1e3d7ef270ea501257fe32bc.pdf	SCS 2211 Part B.pdf	1	2025-04-26 05:07:30.660457
77	313	311	840e0bd03611ee5990597ab1815db379.pdf	upload 1.pdf	about student 	2025-04-26 16:28:14.346132
87	309	311	b696451d593bd455d32206cbdb5cb37c.pdf	upload 1.pdf	about student last credit	2025-04-27 17:46:32.594138
\.


--
-- Data for Name: responsibilities; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.responsibilities (id, advertisement_id, description, created_at) FROM stdin;
\.


--
-- Data for Name: roles; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.roles (id, name, created_at) FROM stdin;
1	admin	2025-04-20 05:47:08.827965
2	student	2025-04-20 05:47:08.827965
3	pdc	2025-04-20 05:47:08.827965
4	company	2025-04-20 05:47:08.827965
5	lecturer	2025-04-20 05:47:08.827965
\.


--
-- Data for Name: second_round_roles; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.second_round_roles (id, internship_role_id, student_id, cv_id, created_at) FROM stdin;
\.


--
-- Data for Name: settings; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.settings (id, key, value, description, created_at) FROM stdin;
1	application_limit_per_student	5	\N	2025-04-20 05:47:32.987013
\.


--
-- Data for Name: students; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.students (id, registration_number, course, index_number, created_at, website) FROM stdin;
311	2022/CS/440	computer science	22001440	2025-04-26 04:51:30.673149	https://thathsara.lk
317	2022/IS/441	computer science	22000440	2025-04-26 17:18:16.636901	\N
415	2022/CS/323	computer science	22001323	2025-04-28 04:52:27.50147	\N
416	2022/IS/324	information systems	22001324	2025-04-28 04:52:36.412343	\N
417	2022/CS/325	computer science	22001325	2025-04-28 04:52:46.476524	\N
\.


--
-- Data for Name: students_qualifications; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.students_qualifications (student_id, qualification_id) FROM stdin;
\.


--
-- Data for Name: techtalk_slots; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.techtalk_slots (id, pdc_id, datetime, venue, slot_created_at) FROM stdin;
32	308	2025-05-20 08:51:00	S104	2025-04-27 01:21:14.359015
31	308	2025-04-30 17:00:00	W004 Hall	2025-04-26 05:05:22.165742
37	308	2025-04-29 13:30:00	S204	2025-04-28 05:56:01.0336
\.


--
-- Data for Name: techtalks; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.techtalks (id, techtalk_slot_id, company_id, host_name, host_email, description, created_at) FROM stdin;
\.


--
-- Data for Name: training_session_registrations; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.training_session_registrations (id, training_session_id, user_id, attended, created_at) FROM stdin;
17	34	311	t	2025-04-26 08:04:59.810908
\.


--
-- Data for Name: training_sessions; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.training_sessions (id, name, date, start_time, venue, end_time, created_at, attendance_code, qrcode_id) FROM stdin;
38	Time Management and Productivity Tools-3	2025-04-30	09:00:00	Hall - 401 	11:00:00	2025-04-28 06:20:06.458286	12345678	22
36	Time Management and Productivity Tools	2025-04-01	00:34:00	Hall - W0257	04:35:00	2025-04-26 22:58:34.564783	ucsc@10%$	20
39	Wijegunasinghe P.M.D	2025-04-30	04:03:00	Hall - W002	07:03:00	2025-04-28 06:23:56.16412	456565	23
34	Internship Orientation and Career Development	2025-04-26	08:30:00	UCSC Hall - W002	11:30:00	2025-04-26 04:59:26.84737	ABC1234@	18
35	Leadership and Teamwork in the Workplace	2025-04-29	08:00:00	UCSC Hall - S102	11:00:00	2025-04-26 22:34:13.223786	UcsC$1225	19
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.users (id, email, password, role, mobile, disabled, approved, name, rejected, photo, bio, linkedin, created_at) FROM stdin;
415	nivethansothilingam19@gmail.com	$2y$10$zMBaznWJ0xkwkfGug0xHe.bZIQgJmhEHefceb8XZwbyv3GpKD4DJ.	2	\N	f	t	Lagithan V.	\N	\N	\N	\N	2025-04-28 04:52:27.336349
416	nivethan1908@gmail.com	$2y$10$wertosdgxQk8HZVdlgz9COiYMJHp60kKL92pASFfM1QfcCCiD7sVS	2	\N	f	t	Nijani T.	\N	\N	\N	\N	2025-04-28 04:52:36.001661
417	sothilingamnivethan19@gmail.com	$2y$10$ZIfME5RFEWUQT81YZQ4t9u3u80o9tS755oNuQ4kW/L.N196M3c66O	2	\N	f	t	Karunya R.	\N	\N	\N	\N	2025-04-28 04:52:46.1413
313	info@wso2.com	$2y$10$oMvM.R.P2F8hF9VFtdl7AOk18h/NyaCU6PSexkId58CMjJLVWw3oe	4	\N	\N	t	WSO2	\N	\N	\N	\N	2025-04-26 06:11:47.253251
309	contact@millenniumitesp.com	$2y$10$2AHTCO7gLfr34k3/hS8E3OvNNwzU9BEfmJcsP4m4kLvyvf8QyLsvK	4	\N	f	t	MillenniumIT ESP	\N	\N	\N	\N	2025-04-26 04:45:36.788972
311	student@launchpad.com	$2y$10$wIDOcFtwzBIZdnJG42qTAOlmwC87cYypc4oEWxPcpvi9jQgM8cC6y	2	0777252917	f	t	Thathsara	\N	d7d99705d80e689eed6aeb765d158956.png	Hello	https://linkedin.com/232nbjbr23jhrb2j3	2025-04-26 04:51:30.51406
390	2022cs223@stu.ucsc.cmb.ac.lk	$2y$12$mcOPcNFvOmFEHbOaqaHplOZB0J69ZIvcb9gunF/Sy70VfDzjpo1VW	5	0716859880	\N	f	P Madushan	\N	\N	\N	\N	2025-04-27 14:22:51.573802
307	nivethannive19@gmail.com	$2y$12$KagYjKmb41PJj2BE6xXJIuReUNeGcpN1s8ih32iB6L1R1.Bsexkum	3	0712233356	\N	f	Nivethan	\N	df873297897a80eac00bbcc705bbf048.jpg	\N	\N	2025-04-26 04:41:04.436573
362	info@techspark.lk	$2y$10$qAjnUM9DRnrhsZJOEW79J.1CjGehhqDCk0iVXOkfs3KOWlWqnMILG	4	\N	f	t	TechSpark Solutions	\N	\N	\N	\N	2025-04-27 00:55:38.067018
1	admin@t.com	$2y$10$K/UlpmI1DiTZ1z87r9xaqOrowNI68zpAKH30CaEfETboXNiYBEuxe	1	\N	\N	t	admin1	\N	a0298fa03895901403ea1909ce1dbcd5.png	\N	\N	2025-04-20 05:48:08.238511
317	niroshan@gmail.com	$2y$10$tufHf6xBvwssA7.8bJ76u.n1BCOVeEncl6/hLWYOyn40YVcnwhZRK	2	\N	f	t	Niroshan	\N	\N	\N	\N	2025-04-26 17:18:16.484229
312	lecturer@launchpad.com	$2y$12$5N5Vu6D95p.xEJliVESp6Oju/hBx7ZWPsq9/pmcY5DMBaOLOgNl3C	5	0716859880	\N	t	Pasindu Madushan	\N	\N	\N	\N	2025-04-26 05:06:24.785194
308	pdc@launchpad.com	$2y$12$r6zQFcmuXqyVsMItqbPsMeCIfiGITH2nbJcf3CLd/RYAJPSvHSu2u	3	0716857777	\N	t	Nivethan	\N	22b327ef65604db79df9e619f6a26cd5.jpg	\N	\N	2025-04-26 04:42:31.185425
436	pmdwijegunasinghe@gmail.com	$2y$12$4ObGS7b7GgAoUjrf82iIHuJmdr.do6I2cjeOlbaen/iJYE34iNnpO	5	0716859880	\N	t	Pasindu Madushan Dias Wijegunasinghe 	\N	\N	\N	\N	2025-04-28 09:20:09.080347
392	newmaillecedit@t.com	$2y$12$4JyOhiwjTduK0YBtJC2fQOAAOTYUBudcGUwO7FApcMblzveFNNt0W	5	0716859880	\N	f	Pasindu Madushan Dias Wijegunasinghe 	\N	\N	\N	\N	2025-04-27 18:29:51.26856
\.


--
-- Name: admins_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.admins_id_seq', 1, false);


--
-- Name: ads_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.ads_id_seq', 184, true);


--
-- Name: ads_qualifications_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.ads_qualifications_id_seq', 1, false);


--
-- Name: applications_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.applications_id_seq', 57, true);


--
-- Name: batches_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.batches_id_seq', 7, true);


--
-- Name: blacklist_reasons_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.blacklist_reasons_id_seq', 8, true);


--
-- Name: companies_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.companies_id_seq', 6, true);


--
-- Name: complaint_messages_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.complaint_messages_id_seq', 49, true);


--
-- Name: complaints_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.complaints_id_seq', 45, true);


--
-- Name: cvs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.cvs_id_seq', 40, true);


--
-- Name: files_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.files_id_seq', 26, true);


--
-- Name: interviews_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.interviews_id_seq', 38, true);


--
-- Name: job_roles_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.job_roles_id_seq', 17, true);


--
-- Name: lecture_visit_lecturers_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.lecture_visit_lecturers_id_seq', 22, true);


--
-- Name: lecturer_visit_rejected_reasons_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.lecturer_visit_rejected_reasons_id_seq', 8, true);


--
-- Name: lecturer_visits_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.lecturer_visits_id_seq', 42, true);


--
-- Name: lecturers_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.lecturers_id_seq', 1, true);


--
-- Name: notifications_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.notifications_id_seq', 287, true);


--
-- Name: password_reset_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.password_reset_id_seq', 1, false);


--
-- Name: qrcodes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.qrcodes_id_seq', 23, true);


--
-- Name: qualifications_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.qualifications_id_seq', 1, false);


--
-- Name: reports_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.reports_id_seq', 87, true);


--
-- Name: responsibilities_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.responsibilities_id_seq', 1, false);


--
-- Name: roles_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.roles_id_seq', 1, false);


--
-- Name: second_round_roles_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.second_round_roles_id_seq', 36, true);


--
-- Name: settings_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.settings_id_seq', 2, true);


--
-- Name: students_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.students_id_seq', 1, false);


--
-- Name: techtalks_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.techtalks_id_seq', 37, true);


--
-- Name: techtalks_id_seq1; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.techtalks_id_seq1', 38, true);


--
-- Name: training_session_attendances_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.training_session_attendances_id_seq', 17, true);


--
-- Name: training_session_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.training_session_id_seq', 39, true);


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.users_id_seq', 436, true);


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

