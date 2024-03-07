<?php
require_once 'BlogPost.php';

// Instantiate BlogPost object
$blogPost = new BlogPost();

// Handle POST request for creating a new post
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $author = $_POST['author'];
    $publication_date = $_POST['publication_date'];
    
    if ($blogPost->createPost($title, $content, $author, $publication_date)) {
        echo "Post created successfully";
    } else {
        echo "Error creating post";
    }
}

// Handle GET request for fetching all posts
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0;
    $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 10;
    $posts = $blogPost->getPosts($offset, $limit);
    echo json_encode($posts);
}

// Handle PUT request for updating a post
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    parse_str(file_get_contents("php://input"), $put_vars);
    $id = $put_vars['id'];
    $title = $put_vars['title'];
    $content = $put_vars['content'];
    $author = $put_vars['author'];
    $publication_date = $put_vars['publication_date'];
    
    if ($blogPost->updatePost($id, $title, $content, $author, $publication_date)) {
        echo "Post updated successfully";
    } else {
        echo "Error updating post";
    }
}

// Handle DELETE request for deleting a post
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    parse_str(file_get_contents("php://input"), $delete_vars);
    $id = $delete_vars['id'];
    
    if ($blogPost->deletePost($id)) {
        echo "Post deleted successfully";
    } else {
        echo "Error deleting post";
    }
}
?>
