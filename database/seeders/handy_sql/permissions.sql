# 1
INSERT INTO `permissions` (`id`, `title_id`, `type`, `name`, `title`, `guard_name`, `created_at`, `updated_at`) VALUES (NULL, '5', '2', 'meeting-list-search', 'جستجوی جلسه', 'web', NULL, NULL);

INSERT INTO `permission_titles` (`id`, `title`, `type`, `created_at`, `updated_at`) VALUES (NULL, 'رويدادها', '2', '2021-05-09 00:00:00', '2021-05-09 00:00:00');

INSERT INTO `permissions` (`id`, `title_id`, `type`, `name`, `title`, `guard_name`, `created_at`, `updated_at`) VALUES (NULL, 8, '2', 'event-list', 'لیست رويدادها', 'web', '2021-05-09 00:00:00', '2021-05-09 00:00:00'), (NULL, 8, '2', 'event-show', 'مشاهده رويداد', 'web', '2021-05-09 00:00:00', '2021-05-09 00:00:00'), (NULL, 8, '2', 'event-edit', 'ویرایش رويداد', 'web', '2021-05-09 00:00:00', '2021-05-09 00:00:00'), (NULL, 8, '2', 'event-delete', 'حذف رويداد', 'web', '2021-05-09 00:00:00', '2021-05-09 00:00:00'), (NULL, 8, '2', 'event-add', 'افزودن رويداد', 'web', '2021-05-09 00:00:00', '2021-05-09 00:00:00')
