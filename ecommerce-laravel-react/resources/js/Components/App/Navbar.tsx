import React from 'react';
import ApplicationLogo from '@/Components/App/ApplicationLogo';
import Dropdown from '@/Components/Core/Dropdown';
import NavLink from '@/Components/Core/NavLink';
import { Link, usePage } from '@inertiajs/react';
import { useState } from 'react';

export default function Navbar() {
    const user = usePage().props.auth?.user;
    const [showingNavigationDropdown, setShowingNavigationDropdown] = useState(false);
    const [isOpen, setIsOpen] = useState(false);

    const categories = [
        { id: 1, name: 'Eletrônicos', href: '/categorias/eletronicos' },
        { id: 2, name: 'Roupas', href: '/categorias/roupas' },
        { id: 3, name: 'Livros', href: '/categorias/livros' },
    ];

    // Estilos padrão de texto para unificar a tipografia da barra
    const textStyle = "text-sm font-medium text-gray-700 transition duration-200 hover:text-blue-600";

    return (
        <div onMouseLeave={() => setIsOpen(false)} className="relative">
            <nav className="border-b border-gray-100 bg-white">
                <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div className="flex h-16 justify-between items-center">
                        
                        <div className="flex items-center space-x-8 h-full">
                            <div className="flex shrink-0 items-center">
                                <Link href={route('dashboard')}>
                                    <ApplicationLogo />
                                </Link>
                            </div>
                            
                            <div className="hidden sm:flex items-center space-x-8 h-full">
                                <NavLink href={route('dashboard')} active={route().current('dashboard')} className={textStyle}>
                                    <span>Início</span>
                                </NavLink>

                                <div className="flex items-center h-full" onMouseEnter={() => setIsOpen(true)}>
                                    <button className={`focus:outline-none flex items-center space-x-1 h-full ${textStyle}`}>
                                        <span>Categorias</span>
                                        <svg className={`w-4 h-4 transform transition-transform duration-300 ${isOpen ? 'rotate-180' : ''}`} fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>
                                </div>

                                <div className="flex w-64 items-center border-b border-gray-200 py-1.5 transition-colors focus-within:border-blue-600">
                                    <svg className="mr-2 h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M21 21l-4.35-4.35m0 0a7.5 7.5 0 10-10.6-10.6 7.5 7.5 0 0010.6 10.6z" />
                                    </svg>
                                    <input 
                                        type="text" 
                                        placeholder="Buscar produtos" 
                                        className="w-full border-0 bg-transparent p-0 text-sm font-medium text-gray-700 placeholder:text-sm placeholder:text-gray-400 focus:outline-none focus:ring-0" 
                                    />
                                </div>
                            </div>
                        </div>

                        <div className="hidden sm:flex sm:items-center space-x-6">

                            <NavLink 
                                href={route('carrinho')} 
                                active={route().current('carrinho')} 
                                className="text-gray-700 hover:text-blue-600 p-2 transition duration-200 flex items-center justify-center"
                            >
                                <svg className="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </NavLink>

                            <div className="relative">
                                {user ? (
                                    <Dropdown>
                                        <Dropdown.Trigger>
                                            <span className="inline-flex ">
                                                <button type="button" className={`inline-flex items-center px-3 py-2 border border-transparent bg-white focus:outline-none ${textStyle}`}>
                                                    {user.name}
                                                    <svg className="ms-2 -me-0.5 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M19 9l-7 7-7-7" />
                                                    </svg>
                                                </button>
                                            </span>
                                        </Dropdown.Trigger>
                                        <Dropdown.Content>
                                            <Dropdown.Link href={route('profile.edit')} className="text-sm font-medium text-gray-700">Perfil</Dropdown.Link>
                                            <Dropdown.Link href={route('logout')} method="post" as="button" className="text-sm font-medium text-gray-700">Sair</Dropdown.Link>
                                        </Dropdown.Content>
                                    </Dropdown>
                                ) : (
                                    <div className="flex space-x-4 items-center">
                                        <Link href={route('login')} className={textStyle}>Entrar</Link>
                                        <Link href={route('register')} className="bg-blue-600 text-white text-sm font-medium px-4 py-2 hover:bg-blue-700 transition duration-200">
                                            Criar conta
                                        </Link>
                                    </div>
                                )}
                            </div>
                        </div>

                    </div>
                </div>
            </nav>

            <div onMouseEnter={() => setIsOpen(true)} onMouseLeave={() => setIsOpen(false)} className={`absolute left-0 right-0 bg-white shadow-lg border-b border-gray-200 z-50 transition-all duration-300 ease-out ${isOpen ? 'opacity-100 translate-y-0 pointer-events-auto' : 'opacity-0 -translate-y-2 pointer-events-none'}`}>
                <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 grid grid-cols-2 md:grid-cols-4 gap-4">
                    {categories.map((category) => (
                        <Link key={category.id} href={category.href} className="block p-3 text-gray-700 hover:bg-gray-50 hover:text-blue-600 transition duration-200 font-medium text-sm" onClick={() => setIsOpen(false)}>
                            {category.name}
                        </Link>
                    ))}
                </div>
            </div>
        </div>
    );
}
