<?php
declare(strict_types=1);

function e(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function setting(PDO $pdo, string $key, string $fallback = ''): string
{
    $stmt = $pdo->prepare('SELECT setting_value FROM site_settings WHERE setting_key = ? LIMIT 1');
    $stmt->execute([$key]);
    $value = $stmt->fetchColumn();

    return $value === false ? $fallback : (string) $value;
}

function rows(PDO $pdo, string $table, string $orderBy = 'sort_order ASC, id DESC', string $where = 'is_active = 1'): array
{
    $allowed = ['programs', 'team_members', 'impact_stories', 'partners', 'knowledge_posts', 'gallery_items'];
    if (!in_array($table, $allowed, true)) {
        return [];
    }

    $sql = "SELECT * FROM {$table}";
    if ($where !== '') {
        $sql .= " WHERE {$where}";
    }
    $sql .= " ORDER BY {$orderBy}";

    return $pdo->query($sql)->fetchAll();
}

function redirect(string $path): never
{
    header("Location: {$path}");
    exit;
}
