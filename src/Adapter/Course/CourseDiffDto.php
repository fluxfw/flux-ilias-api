<?php

namespace FluxIliasApi\Adapter\Course;

use FluxIliasApi\Adapter\CustomMetadata\CustomMetadataDto;

class CourseDiffDto
{

    public ?bool $add_to_favourites;
    public ?bool $availability_always_visible;
    public ?int $availability_end;
    public ?int $availability_start;
    public ?bool $badges;
    public ?bool $calendar;
    public ?bool $calendar_block;
    public ?string $contact_consultation;
    public ?string $contact_email;
    public ?string $contact_name;
    public ?string $contact_phone;
    public ?string $contact_responsibility;
    /**
     * @var CustomMetadataDto[]|null
     */
    public ?array $custom_metadata;
    public ?bool $default_object_rating;
    public ?string $description;
    public ?int $didactic_template_id;
    public ?string $import_id;
    public ?string $important_information;
    public ?string $mail_subject_prefix;
    public ?LegacyCourseMailToMembersType $mail_to_members_type;
    public ?bool $manage_custom_metadata;
    public ?bool $news;
    public ?bool $online;
    public ?int $period_end;
    public ?int $period_start;
    public ?bool $period_time_indication;
    public ?bool $period_unset;
    public ?bool $resources;
    public ?bool $send_welcome_email;
    public ?bool $show_members;
    public ?bool $show_members_participants_list;
    public ?string $syllabus;
    public ?bool $tag_cloud;
    public ?string $target_group;
    public ?string $title;


    /**
     * @param CustomMetadataDto[]|null $custom_metadata
     */
    private function __construct(
        /*public readonly*/ ?string $import_id,
        /*public readonly*/ ?string $title,
        /*public readonly*/ ?string $description,
        /*public readonly*/ ?int $period_start,
        /*public readonly*/ ?int $period_end,
        /*public readonly*/ ?bool $period_unset,
        /*public readonly*/ ?bool $period_time_indication,
        /*public readonly*/ ?bool $online,
        /*public readonly*/ ?int $availability_start,
        /*public readonly*/ ?int $availability_end,
        /*public readonly*/ ?bool $availability_always_visible,
        /*public readonly*/ ?bool $calendar,
        /*public readonly*/ ?bool $calendar_block,
        /*public readonly*/ ?bool $news,
        /*public readonly*/ ?bool $manage_custom_metadata,
        /*public readonly*/ ?bool $tag_cloud,
        /*public readonly*/ ?bool $default_object_rating,
        /*public readonly*/ ?bool $badges,
        /*public readonly*/ ?bool $resources,
        /*public readonly*/ ?string $mail_subject_prefix,
        /*public readonly*/ ?bool $show_members,
        /*public readonly*/ ?bool $show_members_participants_list,
        /*public readonly*/ ?LegacyCourseMailToMembersType $mail_to_members_type,
        /*public readonly*/ ?bool $send_welcome_email,
        /*public readonly*/ ?bool $add_to_favourites,
        /*public readonly*/ ?string $important_information,
        /*public readonly*/ ?string $syllabus,
        /*public readonly*/ ?string $target_group,
        /*public readonly*/ ?string $contact_name,
        /*public readonly*/ ?string $contact_responsibility,
        /*public readonly*/ ?string $contact_phone,
        /*public readonly*/ ?string $contact_email,
        /*public readonly*/ ?string $contact_consultation,
        /*public readonly*/ ?int $didactic_template_id,
        /*public readonly*/ ?array $custom_metadata
    ) {
        $this->import_id = $import_id;
        $this->title = $title;
        $this->description = $description;
        $this->period_start = $period_start;
        $this->period_end = $period_end;
        $this->period_unset = $period_unset;
        $this->period_time_indication = $period_time_indication;
        $this->online = $online;
        $this->availability_start = $availability_start;
        $this->availability_end = $availability_end;
        $this->availability_always_visible = $availability_always_visible;
        $this->calendar = $calendar;
        $this->calendar_block = $calendar_block;
        $this->news = $news;
        $this->manage_custom_metadata = $manage_custom_metadata;
        $this->tag_cloud = $tag_cloud;
        $this->default_object_rating = $default_object_rating;
        $this->badges = $badges;
        $this->resources = $resources;
        $this->mail_subject_prefix = $mail_subject_prefix;
        $this->show_members = $show_members;
        $this->show_members_participants_list = $show_members_participants_list;
        $this->mail_to_members_type = $mail_to_members_type;
        $this->send_welcome_email = $send_welcome_email;
        $this->add_to_favourites = $add_to_favourites;
        $this->important_information = $important_information;
        $this->syllabus = $syllabus;
        $this->target_group = $target_group;
        $this->contact_name = $contact_name;
        $this->contact_responsibility = $contact_responsibility;
        $this->contact_phone = $contact_phone;
        $this->contact_email = $contact_email;
        $this->contact_consultation = $contact_consultation;
        $this->didactic_template_id = $didactic_template_id;
        $this->custom_metadata = $custom_metadata;
    }


    /**
     * @param CustomMetadataDto[]|null $custom_metadata
     */
    public static function new(
        ?string $import_id = null,
        ?string $title = null,
        ?string $description = null,
        ?int $period_start = null,
        ?int $period_end = null,
        ?bool $period_unset = null,
        ?bool $period_time_indication = null,
        ?bool $online = null,
        ?int $availability_start = null,
        ?int $availability_end = null,
        ?bool $availability_always_visible = null,
        ?bool $calendar = null,
        ?bool $calendar_block = null,
        ?bool $news = null,
        ?bool $manage_custom_metadata = null,
        ?bool $tag_cloud = null,
        ?bool $default_object_rating = null,
        ?bool $badges = null,
        ?bool $resources = null,
        ?string $mail_subject_prefix = null,
        ?bool $show_members = null,
        ?bool $show_members_participants_list = null,
        ?LegacyCourseMailToMembersType $mail_to_members_type = null,
        ?bool $send_welcome_email = null,
        ?bool $add_to_favourites = null,
        ?string $important_information = null,
        ?string $syllabus = null,
        ?string $target_group = null,
        ?string $contact_name = null,
        ?string $contact_responsibility = null,
        ?string $contact_phone = null,
        ?string $contact_email = null,
        ?string $contact_consultation = null,
        ?int $didactic_template_id = null,
        ?array $custom_metadata = null
    ) : /*static*/ self
    {
        return new static(
            $import_id,
            $title,
            $description,
            $period_start,
            $period_end,
            $period_unset,
            $period_time_indication,
            $online,
            $availability_start,
            $availability_end,
            $availability_always_visible,
            $calendar,
            $calendar_block,
            $news,
            $manage_custom_metadata,
            $tag_cloud,
            $default_object_rating,
            $badges,
            $resources,
            $mail_subject_prefix,
            $show_members,
            $show_members_participants_list,
            $mail_to_members_type,
            $send_welcome_email,
            $add_to_favourites,
            $important_information,
            $syllabus,
            $target_group,
            $contact_name,
            $contact_responsibility,
            $contact_phone,
            $contact_email,
            $contact_consultation,
            $didactic_template_id,
            $custom_metadata
        );
    }


    public static function newFromData(
        object $data
    ) : /*static*/ self
    {
        return static::new(
            $data->import_id ?? null,
            $data->title ?? null,
            $data->description ?? null,
            $data->period_start ?? null,
            $data->period_end ?? null,
            $data->period_unset ?? null,
            $data->period_time_indication ?? null,
            $data->online ?? null,
            $data->availability_start ?? null,
            $data->availability_end ?? null,
            $data->availability_always_visible ?? null,
            $data->calendar ?? null,
            $data->calendar_block ?? null,
            $data->news ?? null,
            $data->manage_custom_metadata ?? null,
            $data->tag_cloud ?? null,
            $data->default_object_rating ?? null,
            $data->badges ?? null,
            $data->resources ?? null,
            $data->mail_subject_prefix ?? null,
            $data->show_members ?? null,
            $data->show_members_participants_list ?? null,
            ($mail_to_members_type = $data->mail_to_members_type ?? null) !== null ? LegacyCourseMailToMembersType::from($mail_to_members_type) : null,
            $data->send_welcome_email ?? null,
            $data->add_to_favourites ?? null,
            $data->important_information ?? null,
            $data->syllabus ?? null,
            $data->target_group ?? null,
            $data->contact_name ?? null,
            $data->contact_responsibility ?? null,
            $data->contact_phone ?? null,
            $data->contact_email ?? null,
            $data->contact_consultation ?? null,
            $data->didactic_template_id ?? null,
            ($custom_metadata = $data->custom_metadata ?? null) !== null ? array_map([CustomMetadataDto::class, "newFromData"], $custom_metadata) : null
        );
    }
}
