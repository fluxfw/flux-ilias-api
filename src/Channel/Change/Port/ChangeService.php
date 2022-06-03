<?php

namespace FluxIliasApi\Channel\Change\Port;

use FluxIliasApi\Adapter\Change\ChangeDto;
use FluxIliasApi\Adapter\Cron\Change\PurgeChangesCronJob;
use FluxIliasApi\Adapter\Cron\Change\TransferChangesCronJob;
use FluxIliasApi\Adapter\CronConfig\ScheduleTypeCronConfig;
use FluxIliasApi\Adapter\User\UserDto;
use FluxIliasApi\Channel\Category\Port\CategoryService;
use FluxIliasApi\Channel\Change\Command\CreateChangeDatabaseCommand;
use FluxIliasApi\Channel\Change\Command\DropChangeDatabaseCommand;
use FluxIliasApi\Channel\Change\Command\GetChangeCronJobsCommand;
use FluxIliasApi\Channel\Change\Command\GetChangesCommand;
use FluxIliasApi\Channel\Change\Command\GetKeepChangesInsideDaysCommand;
use FluxIliasApi\Channel\Change\Command\GetLastTransferredChangeTimeCommand;
use FluxIliasApi\Channel\Change\Command\GetPurgeChangesCronJobCommand;
use FluxIliasApi\Channel\Change\Command\GetPurgeChangesScheduleCommand;
use FluxIliasApi\Channel\Change\Command\GetTransferChangesCronJobCommand;
use FluxIliasApi\Channel\Change\Command\GetTransferChangesPostUrlCommand;
use FluxIliasApi\Channel\Change\Command\GetTransferChangesScheduleCommand;
use FluxIliasApi\Channel\Change\Command\HandleIliasEventCommand;
use FluxIliasApi\Channel\Change\Command\IsEnableLogChangesCommand;
use FluxIliasApi\Channel\Change\Command\IsEnablePurgeChangesCommand;
use FluxIliasApi\Channel\Change\Command\IsEnableTransferChangesCommand;
use FluxIliasApi\Channel\Change\Command\PurgeChangesCommand;
use FluxIliasApi\Channel\Change\Command\SetEnableLogChangesCommand;
use FluxIliasApi\Channel\Change\Command\SetEnablePurgeChangesCommand;
use FluxIliasApi\Channel\Change\Command\SetEnableTransferChangesCommand;
use FluxIliasApi\Channel\Change\Command\SetKeepChangesInsideDaysCommand;
use FluxIliasApi\Channel\Change\Command\SetLastTransferredChangeTimeCommand;
use FluxIliasApi\Channel\Change\Command\SetPurgeChangesScheduleCommand;
use FluxIliasApi\Channel\Change\Command\SetTransferChangesPostUrlCommand;
use FluxIliasApi\Channel\Change\Command\SetTransferChangesScheduleCommand;
use FluxIliasApi\Channel\Change\Command\TransferChangesCommand;
use FluxIliasApi\Channel\Config\Port\ConfigService;
use FluxIliasApi\Channel\Course\Port\CourseService;
use FluxIliasApi\Channel\CourseMember\Port\CourseMemberService;
use FluxIliasApi\Channel\CronConfig\Port\CronConfigService;
use FluxIliasApi\Channel\File\Port\FileService;
use FluxIliasApi\Channel\Group\Port\GroupService;
use FluxIliasApi\Channel\GroupMember\Port\GroupMemberService;
use FluxIliasApi\Channel\Object\Port\ObjectService;
use FluxIliasApi\Channel\ObjectLearningProgress\Port\ObjectLearningProgressService;
use FluxIliasApi\Channel\OrganisationalUnit\Port\OrganisationalUnitService;
use FluxIliasApi\Channel\OrganisationalUnitStaff\Port\OrganisationalUnitStaffService;
use FluxIliasApi\Channel\Role\Port\RoleService;
use FluxIliasApi\Channel\ScormLearningModule\Port\ScormLearningModuleService;
use FluxIliasApi\Channel\User\Port\UserService;
use FluxIliasApi\Channel\UserRole\Port\UserRoleService;
use FluxIliasApi\Libs\FluxRestApi\Adapter\Api\RestApi;
use ilCronJob;
use ilDBInterface;

class ChangeService
{

    private CategoryService $category_service;
    private ConfigService $config_service;
    private CourseMemberService $course_member_service;
    private CourseService $course_service;
    private CronConfigService $cron_config_service;
    private FileService $file_service;
    private GroupMemberService $group_member_service;
    private GroupService $group_service;
    private ilDBInterface $ilias_database;
    private ObjectLearningProgressService $object_learning_progress_service;
    private ObjectService $object_service;
    private OrganisationalUnitService $organisational_unit_service;
    private OrganisationalUnitStaffService $organisational_unit_staff_service;
    private RestApi $rest_api;
    private RoleService $role_service;
    private ScormLearningModuleService $scorm_learning_module_service;
    private UserRoleService $user_role_service;
    private UserService $user_service;


    private function __construct(
        /*private readonly*/ ilDBInterface $ilias_database,
        /*private readonly*/ ConfigService $config_service,
        /*private readonly*/ CategoryService $category_service,
        /*private readonly*/ CourseService $course_service,
        /*private readonly*/ CourseMemberService $course_member_service,
        /*private readonly*/ FileService $file_service,
        /*private readonly*/ GroupService $group_service,
        /*private readonly*/ GroupMemberService $group_member_service,
        /*private readonly*/ ObjectService $object_service,
        /*private readonly*/ ObjectLearningProgressService $object_learning_progress_service,
        /*private readonly*/ OrganisationalUnitService $organisational_unit_service,
        /*private readonly*/ OrganisationalUnitStaffService $organisational_unit_staff_service,
        /*private readonly*/ RoleService $role_service,
        /*private readonly*/ ScormLearningModuleService $scorm_learning_module_service,
        /*private readonly*/ UserService $user_service,
        /*private readonly*/ UserRoleService $user_role_service,
        /*private readonly*/ RestApi $rest_api,
        /*private readonly*/ CronConfigService $cron_config_service
    ) {
        $this->ilias_database = $ilias_database;
        $this->config_service = $config_service;
        $this->category_service = $category_service;
        $this->course_service = $course_service;
        $this->course_member_service = $course_member_service;
        $this->file_service = $file_service;
        $this->group_service = $group_service;
        $this->group_member_service = $group_member_service;
        $this->object_service = $object_service;
        $this->object_learning_progress_service = $object_learning_progress_service;
        $this->organisational_unit_service = $organisational_unit_service;
        $this->organisational_unit_staff_service = $organisational_unit_staff_service;
        $this->role_service = $role_service;
        $this->scorm_learning_module_service = $scorm_learning_module_service;
        $this->user_service = $user_service;
        $this->user_role_service = $user_role_service;
        $this->rest_api = $rest_api;
        $this->cron_config_service = $cron_config_service;
    }


    public static function new(
        ilDBInterface $ilias_database,
        ConfigService $config_service,
        CategoryService $category_service,
        CourseService $course_service,
        CourseMemberService $course_member_service,
        FileService $file_service,
        GroupService $group_service,
        GroupMemberService $group_member_service,
        ObjectService $object_service,
        ObjectLearningProgressService $object_learning_progress_service,
        OrganisationalUnitService $organisational_unit_service,
        OrganisationalUnitStaffService $organisational_unit_staff_service,
        RoleService $role_service,
        ScormLearningModuleService $scorm_learning_module_service,
        UserService $user_service,
        UserRoleService $user_role_service,
        RestApi $rest_api,
        CronConfigService $cron_config_service
    ) : /*static*/ self
    {
        return new static(
            $ilias_database,
            $config_service,
            $category_service,
            $course_service,
            $course_member_service,
            $file_service,
            $group_service,
            $group_member_service,
            $object_service,
            $object_learning_progress_service,
            $organisational_unit_service,
            $organisational_unit_staff_service,
            $role_service,
            $scorm_learning_module_service,
            $user_service,
            $user_role_service,
            $rest_api,
            $cron_config_service
        );
    }


    public function createChangeDatabase() : void
    {
        CreateChangeDatabaseCommand::new(
            $this->ilias_database
        )
            ->createChangeDatabase();
    }


    public function dropChangeDatabase() : void
    {
        DropChangeDatabaseCommand::new(
            $this->ilias_database
        )
            ->dropChangeDatabase();
    }


    /**
     * @return ilCronJob[]
     */
    public function getChangeCronJobs() : array
    {
        return GetChangeCronJobsCommand::new(
            $this
        )
            ->getChangeCronJobs();
    }


    /**
     * @return ChangeDto[]
     */
    public function getChanges(?float $from = null, ?float $to = null, ?float $after = null, ?float $before = null) : array
    {
        return GetChangesCommand::new(
            $this->ilias_database
        )
            ->getChanges(
                $from,
                $to,
                $after,
                $before
            );
    }


    public function getKeepChangesInsideDays() : int
    {
        return GetKeepChangesInsideDaysCommand::new(
            $this->config_service
        )
            ->getKeepChangesInsideDays();
    }


    public function getLastTransferredChangeTime() : ?float
    {
        return GetLastTransferredChangeTimeCommand::new(
            $this->config_service
        )
            ->getLastTransferredChangeTime();
    }


    public function getPurgeChangesCronJob() : PurgeChangesCronJob
    {
        return GetPurgeChangesCronJobCommand::new(
            $this
        )
            ->getPurgeChangesCronJob();
    }


    public function getPurgeChangesSchedule() : object
    {
        return GetPurgeChangesScheduleCommand::new(
            $this,
            $this->cron_config_service
        )
            ->getPurgeChangesSchedule();
    }


    public function getTransferChangesCronJob() : TransferChangesCronJob
    {
        return GetTransferChangesCronJobCommand::new(
            $this
        )
            ->getTransferChangesCronJob();
    }


    public function getTransferChangesPostUrl() : string
    {
        return GetTransferChangesPostUrlCommand::new(
            $this->config_service
        )
            ->getTransferChangesPostUrl();
    }


    public function getTransferChangesSchedule() : object
    {
        return GetTransferChangesScheduleCommand::new(
            $this,
            $this->cron_config_service
        )
            ->getTransferChangesSchedule();
    }


    public function handleIliasEvent(UserDto $user, string $component, string $event, array $parameters) : void
    {
        HandleIliasEventCommand::new(
            $this->ilias_database,
            $this,
            $this->category_service,
            $this->course_service,
            $this->course_member_service,
            $this->file_service,
            $this->group_service,
            $this->group_member_service,
            $this->object_service,
            $this->object_learning_progress_service,
            $this->organisational_unit_service,
            $this->organisational_unit_staff_service,
            $this->role_service,
            $this->scorm_learning_module_service,
            $this->user_service,
            $this->user_role_service
        )
            ->handleIliasEvent(
                $user,
                $component,
                $event,
                $parameters
            );
    }


    public function isEnableLogChanges() : bool
    {
        return IsEnableLogChangesCommand::new(
            $this->config_service
        )
            ->isEnableLogChanges();
    }


    public function isEnablePurgeChanges() : bool
    {
        return IsEnablePurgeChangesCommand::new(
            $this,
            $this->cron_config_service
        )
            ->isEnablePurgeChanges();
    }


    public function isEnableTransferChanges() : bool
    {
        return IsEnableTransferChangesCommand::new(
            $this,
            $this->cron_config_service
        )
            ->isEnableTransferChanges();
    }


    public function purgeChanges() : int
    {
        return PurgeChangesCommand::new(
            $this->ilias_database,
            $this
        )
            ->purgeChanges();
    }


    public function setEnableLogChanges(bool $enable_log_changes) : void
    {
        SetEnableLogChangesCommand::new(
            $this->config_service
        )
            ->setEnableLogChanges(
                $enable_log_changes
            );
    }


    public function setEnablePurgeChanges(bool $enable_purge_changes) : void
    {
        SetEnablePurgeChangesCommand::new(
            $this,
            $this->cron_config_service
        )
            ->setEnablePurgeChanges(
                $enable_purge_changes
            );
    }


    public function setEnableTransferChanges(bool $enable_transfer_changes) : void
    {
        SetEnableTransferChangesCommand::new(
            $this,
            $this->cron_config_service
        )
            ->setEnableTransferChanges(
                $enable_transfer_changes
            );
    }


    public function setKeepChangesInsideDays(?int $keep_changes_inside_days) : void
    {
        SetKeepChangesInsideDaysCommand::new(
            $this->config_service
        )
            ->setKeepChangesInsideDays(
                $keep_changes_inside_days
            );
    }


    public function setLastTransferredChangeTime(float $last_transferred_change_time) : void
    {
        SetLastTransferredChangeTimeCommand::new(
            $this->config_service
        )
            ->setLastTransferredChangeTime(
                $last_transferred_change_time
            );
    }


    public function setPurgeChangesSchedule(ScheduleTypeCronConfig $type, ?int $interval = null) : void
    {
        SetPurgeChangesScheduleCommand::new(
            $this,
            $this->cron_config_service
        )
            ->setPurgeChangesSchedule(
                $type,
                $interval
            );
    }


    public function setTransferChangesPostUrl(string $transfer_changes_url) : void
    {
        SetTransferChangesPostUrlCommand::new(
            $this->config_service
        )
            ->setTransferChangesPostUrl(
                $transfer_changes_url
            );
    }


    public function setTransferChangesSchedule(ScheduleTypeCronConfig $type, ?int $interval = null) : void
    {
        SetTransferChangesScheduleCommand::new(
            $this,
            $this->cron_config_service
        )
            ->setTransferChangesSchedule(
                $type,
                $interval
            );
    }


    public function transferChanges() : ?int
    {
        return TransferChangesCommand::new(
            $this->ilias_database,
            $this,
            $this->rest_api
        )
            ->transferChanges();
    }
}
