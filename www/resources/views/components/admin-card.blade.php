@props([
    'email' => 'email@example.com',
    'admin' => 'Admin Example',
    'image' => 'https://picsum.photos/200/300',
    'color' => 'white',
    'active'
    ])

<x-card
    :active="$active"
    :image="$image"
    :email="$email"
    :entity="$admin"
    :color="$color"
/>
