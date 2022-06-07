<?php

namespace FluxIliasApi\Adapter\Course;

use FluxIliasApi\Adapter\CustomMetadata\CustomMetadataDto;
use JsonSerializable;

class CourseDto implements JsonSerializable
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
    public ?int $created;
    /**
     * @var CustomMetadataDto[]|null
     */
    public ?array $custom_metadata;
    public ?bool $default_object_rating;
    public ?string $description;
    public ?int $didactic_template_id;
    public ?string $icon_url;
    public ?int $id;
    public ?string $import_id;
    public ?string $important_information;
    public ?bool $in_trash;
    public ?string $mail_subject_prefix;
    public ?LegacyCourseMailToMembersType $mail_to_members_type;
    public ?bool $manage_custom_metadata;
    public ?bool $news;
    public ?bool $online;
    public ?int $parent_id;
    public ?string $parent_import_id;
    public ?int $parent_ref_id;
    public ?int $period_end;
    public ?int $period_start;
    public ?bool $period_time_indication;
    public ?int $ref_id;
    public ?bool $resources;
    public ?bool $send_welcome_email;
    public ?bool $show_members;
    public ?bool $show_members_participants_list;
    public ?string $syllabus;
    public ?bool $tag_cloud;
    public ?string $target_group;
    public ?string $title;
    public ?int $updated;
    public ?string $url;


    /**
     * @param CustomMetadataDto[]|null $custom_metadata
     */
    private function __construct(
        /*public readonly*/ ?int $id,
        /*public readonly*/ ?string $import_id,
        /*public readonly*/ ?int $ref_id,
        /*public readonly*/ ?int $created,
        /*public readonly*/ ?int $updated,
        /*public readonly*/ ?int $parent_id,
        /*public readonly*/ ?string $parent_import_id,
        /*public readonly*/ ?int $parent_ref_id,
        /*public readonly*/ ?string $url,
        /*public readonly*/ ?string $icon_url,
        /*public readonly*/ ?string $title,
        /*public readonly*/ ?string $description,
        /*public readonly*/ ?int $period_start,
        /*public readonly*/ ?int $period_end,
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
        /*public readonly*/ ?bool $in_trash,
        /*public readonly*/ ?array $custom_metadata
    ) {
        $this->id = $id;
        $this->import_id = $import_id;
        $this->ref_id = $ref_id;
        $this->created = $created;
        $this->updated = $updated;
        $this->parent_id = $parent_id;
        $this->parent_import_id = $parent_import_id;
        $this->parent_ref_id = $parent_ref_id;
        $this->url = $url;
        $this->icon_url = $icon_url;
        $this->title = $title;
        $this->description = $description;
        $this->period_start = $period_start;
        $this->period_end = $period_end;
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
        $this->in_trash = $in_trash;
        $this->custom_metadata = $custom_metadata;
    }


    /**
     * @param CustomMetadataDto[]|null $custom_metadata
     */
    public static function new(
        ?int $id = null,
        ?string $import_id = null,
        ?int $ref_id = null,
        ?int $created = null,
        ?int $updated = null,
        ?int $parent_id = null,
        ?string $parent_import_id = null,
        ?int $parent_ref_id = null,
        ?string $url = null,
        ?string $icon_url = null,
        ?string $title = null,
        ?string $description = null,
        ?int $period_start = null,
        ?int $period_end = null,
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
        ?bool $in_trash = null,
        ?array $custom_metadata = null
    ) : /*static*/ self
    {
        return new static(
            $id,
            $import_id,
            $ref_id,
            $created,
            $updated,
            $parent_id,
            $parent_import_id,
            $parent_ref_id,
            $url,
            $icon_url,
            $title,
            $description,
            $period_start,
            $period_end,
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
            $in_trash,
            $custom_metadata
        );
    }


    public function jsonSerialize() : object
    {
        $data = get_object_vars($this);

        unset($data["in_trash"]);

        return (object) $data;
    }
}
