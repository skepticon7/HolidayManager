import {useNavigate} from "react-router-dom";
import {Flex, Heading, Image, Link, Stack , Text} from "@chakra-ui/react";
import SignupForm from "../shared/SignupForm.jsx";
const Signup = () => {
    // const navigate = useNavigate();
    return (
        <Stack minW={'100vw'} minH={'100vh'} direction={{base: 'column', md: 'row'}}>
            <Flex p={8} flex={1}  alignItems={'center'} justifyContent={'center'}>
                <Stack spacing={5} w={'full'} maxW={'md'}>
                    <Heading alignSelf={'center'} fontSize={'2xl'} mb={15}>Register for an account</Heading>
                    <SignupForm onSuccess={() => {
                        // localStorage.setItem("access_token", token)
                        // setCustomerFromToken()
                        // navigate("/home");
                    }}/>
                    <Link color={"green.600"} href={"/"}>
                        Have an account? Login now.
                    </Link>
                </Stack>
            </Flex>
            <Flex
                flex={1}
                p={50}
                flexDirection={"column"}
                alignItems={"center"}
                justifyContent={"center"}
                bgGradient={{sm: 'linear(to-r, green.500, blue.800)'}}
            >
                <Text fontSize={"6xl"} color={'white'} fontWeight={"bold"} mb={10}>
                    <Text >
                        TripTales
                    </Text>
                </Text>
                <Image
                    alt={'Login Image'}
                    objectFit={'scale-down'}
                    w={'90%'}
                    src={
                        'https://user-images.githubusercontent.com/40702606/215539167-d7006790-b880-4929-83fb-c43fa74f429e.png'
                    }
                />
            </Flex>
        </Stack>
    );
}

export default Signup;